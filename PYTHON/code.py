from pathlib import Path

import joblib
import pandas as pd
from sklearn.linear_model import LogisticRegression
from sklearn.pipeline import make_pipeline
from sklearn.preprocessing import StandardScaler


BASE_DIR = Path(__file__).resolve().parent.parent
DATA_PATH = BASE_DIR / "DATA" / "cancer_data.csv"
MODEL_PATH = BASE_DIR / "MODEL" / "ecmt.joblib"
FEATURES = ["radius_mean", "texture_mean", "perimeter_mean"]


def train_model() -> None:
    if not DATA_PATH.is_file():
        raise FileNotFoundError(f"Training dataset not found: {DATA_PATH}")

    data = pd.read_csv(DATA_PATH)
    required = set(FEATURES + ["diagnosis"])
    missing = sorted(required - set(data.columns))
    if missing:
        raise ValueError("Dataset is missing columns: " + ", ".join(missing))

    data["cancer"] = data["diagnosis"].map({"M": 1, "B": 0})
    if data["cancer"].isna().any():
        raise ValueError("Diagnosis must contain only 'M' or 'B' values.")

    training_data = data[FEATURES].apply(pd.to_numeric, errors="coerce")
    if training_data.isna().any().any():
        raise ValueError("Training features must contain only numeric values.")

    model = make_pipeline(
        StandardScaler(),
        LogisticRegression(max_iter=1000, random_state=42),
    )
    model.fit(training_data, data["cancer"])

    MODEL_PATH.parent.mkdir(parents=True, exist_ok=True)
    joblib.dump(model, MODEL_PATH)
    print(f"Model trained and saved at {MODEL_PATH}")


if __name__ == "__main__":
    train_model()
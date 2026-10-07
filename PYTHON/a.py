import sys
from pathlib import Path

import joblib
import numpy as np
import pandas as pd


BASE_DIR = Path(__file__).resolve().parent.parent
MODEL_PATH = BASE_DIR / "MODEL" / "ecmt.joblib"


def main() -> None:
    if len(sys.argv) != 4:
        raise SystemExit(
            "Usage: python a.py <radius_mean> <texture_mean> <perimeter_mean>"
        )

    try:
        values = [float(value) for value in sys.argv[1:]]
    except ValueError as error:
        raise SystemExit("All measurements must be numeric.") from error
    if not np.isfinite(values).all():
        raise SystemExit("Measurements must be finite numbers.")
    if not MODEL_PATH.is_file():
        raise FileNotFoundError(
            f"Trained model not found: {MODEL_PATH}. Run PYTHON/code.py first."
        )

    model = joblib.load(MODEL_PATH)
    prediction = model.predict(
        pd.DataFrame(
            [values],
            columns=["radius_mean", "texture_mean", "perimeter_mean"],
        )
    )[0]
    if prediction not in (0, 1):
        raise ValueError(f"Unexpected prediction label: {prediction!r}")
    print(int(prediction))


if __name__ == "__main__":
    main()

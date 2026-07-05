import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.linear_model import LogisticRegression
import joblib
import os

# Path settings
BASE_DIR = os.path.dirname(os.path.abspath(__file__))
data_path = os.path.join(BASE_DIR, "../DATA/cancer_data.csv")
model_path = os.path.join(BASE_DIR, "../MODEL/ecmt.joblib")

# Load dataset
data = pd.read_csv(data_path)

# Map diagnosis to numeric target (1 for malignant, 0 for benign)
data['cancer'] = data['diagnosis'].map({'M': 1, 'B': 0})

# Features & target
X = data[["radius_mean", "texture_mean", "perimeter_mean"]]
y = data["cancer"]

# Train model
model = LogisticRegression()
model.fit(X, y)

# Save model
joblib.dump(model, model_path)
print("Model trained and saved at", model_path)
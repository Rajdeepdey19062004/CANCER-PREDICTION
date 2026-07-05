import sys
import joblib
import os
import numpy as np

# Path settings
BASE_DIR = os.path.dirname(os.path.abspath(__file__))
model_path = os.path.join(BASE_DIR, "../MODEL/ecmt.joblib")

# Load trained model
model = joblib.load(model_path)

# Get user input (from PHP via command line)
radius_mean = float(sys.argv[1])
texture_mean = float(sys.argv[2])
perimeter_mean = float(sys.argv[3])

# Prediction
features = np.array([[radius_mean, texture_mean, perimeter_mean]])
prediction = model.predict(features)[0]

# Print result (0 = No Cancer, 1 = Cancer)
print(prediction)
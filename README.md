# Cancer Prediction System

## Overview

The Cancer Prediction System is a Machine Learning-based web application that predicts whether a patient may have cancer based on selected medical measurements.

The project combines:

* Python
* Machine Learning (Scikit-Learn)
* PHP
* HTML/CSS
* Logistic Regression Model

The user enters medical parameters through a web interface, and the system uses a trained machine learning model to generate a prediction.

---

## Features

* User-friendly web interface
* Machine Learning-based prediction
* Fast result generation
* Cancer / No Cancer classification
* PHP and Python integration
* Local deployment support

---

## Technologies Used

### Frontend

* HTML5
* CSS3

### Backend

* PHP

### Machine Learning

* Python
* NumPy
* Pandas
* Scikit-Learn
* Joblib

---

## Project Structure

```text
WEB PROJECT/
│
├── PHP/
│   ├── index.php
│   ├── process.php
│   └── css/
│
├── PYTHON/
│   ├── code.py
│   └── a.py
│
├── MODEL/
│   └── ecmt.joblib
│
├── IMAGES/
│   ├── d.jpg
│   └── h.jpg
│
└── README.md
```

---

## How It Works

### Step 1: Training the Model

The `code.py` file trains a Logistic Regression model using cancer-related medical data.

```bash
python3 code.py
```

The trained model is saved as:

```text
MODEL/ecmt.joblib
```

---

### Step 2: User Input

The user enters:

* Radius Mean
* Texture Mean
* Perimeter Mean

through the web form.

---

### Step 3: Prediction

The PHP application sends the values to:

```text
PYTHON/a.py
```

The Python script loads the trained model and performs prediction.

Output:

```text
1 = Cancer Detected
0 = No Cancer
```

---

### Step 4: Display Result

Based on the prediction:

* Cancer image and warning message are shown.
* Healthy image and confirmation message are shown.

---

## Installation

### Clone Repository

```bash
git clone <repository-url>
cd WEB-PROJECT
```

### Install PHP

Ubuntu:

```bash
sudo apt update
sudo apt install php -y
```

### Install Python Dependencies

```bash
pip install pandas numpy scikit-learn joblib
```

---

## Running the Project

### Train Model

```bash
cd PYTHON
python3 code.py
```

### Start PHP Server

```bash
cd PHP
php -S localhost:8000
```

### Open Browser

```text
http://localhost:8000
```

---

## Important Files

### code.py

Used to train the machine learning model.

### a.py

Loads the trained model and generates predictions.

### process.php

Acts as the bridge between PHP and Python.

### ecmt.joblib

Stores the trained machine learning model.

---

## Future Improvements

* More medical parameters
* Higher prediction accuracy
* Database integration
* User authentication
* Prediction history
* Graphical analytics dashboard

---

## Educational Purpose

This project was developed for learning purposes to demonstrate the integration of:

* Machine Learning
* Python
* PHP
* Web Development

---

## Author

Sayan Mahalanabish

BCA Student | Technical Explorer

GitHub: https://github.com/sayan08880

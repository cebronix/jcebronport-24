import cv2

# Load the image
image = cv2.imread('image.jpg')

# Convert to grayscale
gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)

# Apply edge detection
edges = cv2.Canny(gray, 100, 200)

# Find contours
contours, hierarchy = cv2.findContours(edges, cv2.RETR_TREE, cv2.CHAIN_APPROX_SIMPLE)

# Draw contours on original image
cv2.drawContours(image, contours, -1, (0, 255, 0), 3)

# Display image with contours
cv2.imshow('Contours', image)
cv2.waitKey(0)

# Extract panels
for i, contour in enumerate(contours):
  # Get bounding rectangle
  x, y, w, h = cv2.boundingRect(contour)
  
  # Extract panel as separate image
  panel = image[y:y+h, x:x+w]
  
  # Save panel to disk
  cv2.imwrite(f'panel_{i}.jpg', panel)

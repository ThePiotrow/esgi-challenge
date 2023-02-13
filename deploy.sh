echo "Deploying changes..."
# Pull changes from the live branch
git pull

# Shut down the existing containers
docker-compose down

# Build the image with the new changes
docker-compose build

# Start the new containers
docker-compose up -d
echo "Deployed!"
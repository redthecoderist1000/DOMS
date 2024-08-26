#!/bin/bash

# Start Docker service (required inside the container)
service docker start

# Give Docker some time to start
sleep 5

# Run Docker Compose
docker-compose up --build

# Keep the container running by tailing a log file or waiting indefinitely
tail -f /dev/null
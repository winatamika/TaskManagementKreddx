#!/bin/bash

# Display a welcome message
echo "Welcome to the bash script testing!"

# Get user input
read -p "Enter your name: " name
echo "Hello, $name!"

# Perform a calculation
read -p "Enter a number: " number
result=$((number * 2))
echo "The result is: $result"

# Display a goodbye message
echo "Thank you for testing the bash script. Goodbye!"

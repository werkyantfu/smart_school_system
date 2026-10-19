# Server Setup Guide
## How to prepare an Ubuntu Server for Smart SMS

**Project Name:** Smart SMS
**Date:** October 2026

---

## 1. Server Requirements
To run this system, you need a Virtual Private Server (VPS) with:
- **OS:** Ubuntu 24.04 LTS
- **RAM:** Minimum 2GB
- **Storage:** 20GB SSD

## 2. Install Required Software
Connect to your server via SSH and run these commands:

```bash
# Update the server
sudo apt update && sudo apt upgrade -y

# Install Nginx (Web Server)
sudo apt install nginx -y

# Install PHP 8.5 and required extensions
sudo apt install php8.5-fpm php8.5-mysql php8.5-mbstring php8.5-xml php8.5-curl php8.5-zip -y

# Install MySQL Database
sudo apt install mysql-server -y

# Install Composer (PHP Package Manager)
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js and NPM
sudo apt install nodejs npm -y
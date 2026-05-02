# SR Greenscapes - Deployment Guide

## Pre-Deployment Checklist

- [x] Fix bootstrap/app.php route() issue
- [x] Build frontend assets (`npm run build`)
- [ ] Push code to GitHub
- [ ] Set up cPanel database
- [ ] Configure .env on live server
- [ ] Run migrations
- [ ] Set up SSL certificate
- [ ] Configure DNS

## Step 1: Push Code to GitHub

If you haven't already, initialize git and push to GitHub:

```bash
cd c:\Users\varalakshmi\Desktop\Nursary
git init
git add .
git commit -m "Initial commit - SR Greenscapes application"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/srgreenscapes.git
git push -u origin main
```

## Step 2: Set Up cPanel & Database

1. **Login to cPanel** at your hosting provider
2. **Create MySQL Database:**
   - Go to "MySQL Databases"
   - Create new database: `srgreenscapes_db`
   - Create new user: `srgreenscapes_user`
   - Assign user to database with ALL privileges
   - Note the database credentials

3. **Create Public HTML Folder:**
   - Your `public` folder should be in `public_html/`
   - Everything else goes one level above in the home directory

## Step 3: Deploy via Git

### Option A: Auto-Deploy (Recommended)
1. In cPanel, go to "Git Version Control"
2. Click "Create"
3. Repository URL: `https://github.com/YOUR_USERNAME/srgreenscapes.git`
4. Repository path: `/home/username/srgreenscapes`
5. Branch: `main`
6. Click Create

### Option B: Manual via SSH
```bash
cd ~/
git clone https://github.com/YOUR_USERNAME/srgreenscapes.git
```

## Step 4: Configure Environment

1. **SSH into your server:**
```bash
ssh username@srgreenscapes.com
```

2. **Create .env file from template:**
```bash
cd ~/srgreenscapes
cp .env.production .env
```

3. **Edit .env with your live database credentials:**
```bash
nano .env
```

Update these values:
```
APP_DEBUG=false
APP_URL=https://srgreenscapes.com
DB_HOST=localhost
DB_DATABASE=srgreenscapes_db
DB_USERNAME=srgreenscapes_user
DB_PASSWORD=your_password_here
MAIL_USERNAME=your-gmail@gmail.com
MAIL_PASSWORD=your-app-password
```

## Step 5: Install Dependencies & Run Migrations

```bash
cd ~/srgreenscapes

# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Clear caches
php artisan optimize:clear

# Run migrations
php artisan migrate --force

# Seed database (if needed - optional)
php artisan db:seed --force

# Create public storage symlink (REQUIRED for images to work)
php artisan storage:link

# Set permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

## Step 6: Configure Public Folder

In cPanel:
1. Go to "Addon Domains" or "Domains"
2. Point `srgreenscapes.com` to `/home/username/srgreenscapes/public`

## Step 7: SSL Certificate

1. In cPanel, go to "AutoSSL" or "Let's Encrypt SSL"
2. Install SSL for your domain
3. Update `.env`:
```
APP_URL=https://srgreenscapes.com
```

## Step 8: Configure .htaccess

Create or update `public/.htaccess`:

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

## Step 9: Verify Installation

Visit your domain:
```
https://srgreenscapes.com
```

Should see the homepage. If 500 error:
```bash
cd ~/srgreenscapes
php artisan optimize:clear
tail -f storage/logs/laravel.log
```

## Post-Deployment

### Enable Scheduled Tasks (cPanel)

Add cron job in cPanel > Cron Jobs:

```bash
* * * * * /usr/bin/php /home/username/srgreenscapes/artisan schedule:run >> /dev/null 2>&1
```

### Monitor Logs

```bash
tail -f ~/srgreenscapes/storage/logs/laravel.log
```

### Regular Updates

```bash
cd ~/srgreenscapes
git pull origin main
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan optimize
```

## Troubleshooting

### 500 Error
```bash
php artisan optimize:clear
php artisan config:cache
```

### Permission Denied
```bash
chmod -R 755 storage bootstrap/cache
```

### Database Connection Error
```bash
# Verify credentials in .env
php artisan db:show
```

### Mail Not Sending
- Verify SMTP credentials in `.env`
- Check spam folder
- Test with `php artisan tinker` and send test email

## Support

For issues, check:
- `storage/logs/laravel.log`
- cPanel error logs
- Application error page (if debug enabled)


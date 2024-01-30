# Readme

This WordPress website is managed through [composer](https://getcomposer.org). Any plugin installations and updates
should ideally be managed through composer, so they can be stored in version control.

## Installation

To install this website, start by cloning the project locally or on the server you wish to run it. Next, complete the
pre-install configuration in the next section.

### Pre-install Configuration

First, copy the `.env.example` file to `.env` and open it with your preferred editor. Then, fill in the proper values
for each setting.

Next, copy the `.wp-install.example` file to `.wp-install` and open it with your preferered editor. Then again, fill in
the proper values for each setting.

 - `ADMIN_USER`: Username for the admin user of the site
 - `ADMIN_EMAIL`: Email address for the admin user of the site
 - `SITE_TITLE`: Website title
 - `SITE_URL`: Website URL

### Install dependencies

The last step in the installation is to install all dependencies by running `composer install` in the root directory. 
Once the process is complete, your website should be ready for you.

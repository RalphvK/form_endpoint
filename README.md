# form_endpoint

This is an experimental form endpoint system, designed to provide a simple, self-hosted solution that can be deployed to any regular PHP host.

The primary use-case for this project is providing form endpoints for static sites hosted on platforms such as Github Pages and Netlify.

# Installation

It is not recommended you use this project in a production environment, as it is far from finished. Pre-requisites for this project are:

* PHP and Composer

* MySQL database and user

When you have these fulfilled these requirements, you can install the project in three steps:

1. Clone this repository: ```git clone https://github.com/RalphvK/form_endpoint.git```

2. Next, configure the application by replacing the default values in ```.env.example``` and renaming this file to ```.env```.

3. Finally, prepare the database tables by running ```composer migrate```.

# User Management

For the time being, user management is handled through composer scripts. Eventually, the admin panel should include a user manager as well.

### Register a new user

New users can be created using the ```composer user register [name] [email] [password]``` command. This command accepts three additional parameters: name, email address and password. The email address is the identifier and must be unique. The name does not have to be unique. For example:

```bash
composer user register John john@example.com admin123
```

### Set new password

Passwords can be changed using the ```composer user set_password [email] [new password]``` command. This command accepts two additional parameters: the email address (identifier) and the new password. For example:

```bash
composer user set_password john@example.com hunter2
```

### Delete a user

Users can be deleted using the ```composer user delete [email]``` command.

```bash
composer user delete john@example.com
```

### Get list of users

You can see a list of all registered users using the ```composer user list``` command.

# Admin Panel

The admin panel can be accessed by approaching the ```/admin``` route.

## Registering a new form

#### Create new form record

After logging in, you are redirected to the ```/admin``` page. This page lists all the forms in the system. You can create a new form by clicking the "new form" button below the records, and entering a display name. Once created, you will be redirected to the edit page for that form.

#### CORS whitelist

You can set allowed cross-origins in the ```whitelist``` field. The syntax is a simple ```,``` or ```, ``` delimited string. For example:

```csv
https://example.com, https://cors.org
```

#### Set field validation rules

After the record has been created, add a json array containing validation rules in the "Validation Rules" field. This JSON string will be loaded as a PHP array via the ```json_decode()``` function and passed to the validation method. For example:

```json
{
   "name": "required|min:2|max:200",
   "company": "max:200",
   "email": "required|email",
   "message": "required|min:10|max:50000"
}
```

The fields are validated using the ```rakit/validation``` library. Its documentation can be found [on Github](https://github.com/rakit/validation).

#### Notification Methods

You can configure how you would like to be notified upon form submission for each form. This is done through json stored in the "Notification Settings" field. You can add new notification methods by creating a new file in the ```forms_api/app/components/notify/notifiers``` folder. All PHP files in this folder are included automatically.

Example configuration for email notifications:

```json
{
    "email": {
        "smtp": {
            "host": "smtp.example.com",
            "port": "465",
            "username": "example",
            "password": "",
            "from_address": "noreply@example.com",
            "from_name": "Form Endpoint"
        },
        "to": {
            "address": "admin@example.com",
            "name": "Admin"
        },
        "replyTo": {
            "address_field": "email",
            "name_field": "name"
        }
    }
}
```

## Hooking up the form

Once your form is registered, you can send data by sending form data to the following route:

```xml
https://<your-api-domain>/form/<public_ID>
```

For example: ```https://forms.example.com/form/SaGWK0muFVJG9RUkNpqMR3FMTB84BsHu```

This information is also displayed on the edit page as two read-only fields containing the ```public_id``` and the public url from that id.
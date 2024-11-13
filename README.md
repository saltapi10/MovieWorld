# MovieWorld

## Install sudo from Git bash terminal in windows.

Step 1:

Open a Git bash Terminal

Step 2 (Optional): Install choco

With PowerShell, you must ensure Get-ExecutionPolicy is not Restricted. We suggest using Bypass to bypass the policy to get things installed or AllSigned for quite a bit more security.

Run
>Get-ExecutionPolicy

If it returns Restricted, then run Set-ExecutionPolicy AllSigned or Set-ExecutionPolicy Bypass -Scope Process.
Now run the following command:

>Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://community.chocolatey.org/install.ps1'))

Paste the copied text into your shell and press Enter.
Wait a few seconds for the command to complete.
If you don't see any errors, you are ready to use Chocolatey! Type choco or choco -? now, or see Getting Started for usage instructions.

Step 3: Install sudo

> choco install sudo

## Fetch laravel packages and Bring all containers up

Got o the project root path in terminal and run:

> docker-compose up -d

And then to fetch the core files

app_name : movieworld_app
> docker-compose exec [app_name] bash

> composer install

And then again build all containers and run

> docker-compose build

> docker-compose up -d

Generate a Laravel App Key.
> php artisan key:generate


Run the database migrations.
>php artisan migrate


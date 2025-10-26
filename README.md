#  About AfriGuard

Afriguard's MVP stage project offers value to SMEs businesses looking for automated operations, easy implementation, offline capability & continuous security monitoring with accessible results and actionable guidance.

## Installation

To deploy this project on your local server after cloning or pulling to your PC, you'll need to have composer install(for windows users) or homebrew(for mac and linux users), which you can of course get at...

Download composer at: https://getcomposer.org/

or
Download composer at: https://brew.sh/

After the installation, you then need to run this command.

```bash
  composer install 
```

And then migrate your backend

```bash
  php artisan migrate 
```

Duplicate the .env.example file in the repo and rename yours to .env only so it works for your local, run 


```bash
  php artisan key:generate
```

And then, serve your project


```bash
  php artisan serve
```

Then visit to see your project backend starting point

```bash
    localhost:8000/api/v1
```    


## Author

- [@Praisebuka]('https://github.com/Praisebuka')


## 🔗 Links
[![Vercel Frontend](https://img.shields.io/badge/my_portfolio-000?style=for-the-badge&logo=ko-fi&logoColor=white)](https://afriguard-frontend.vercel.app)
[![Netlify Frontend](https://img.shields.io/badge/my_portfolio-000?style=for-the-badge&logo=ko-fi&logoColor=white)](https://afriguard.netlify.app)


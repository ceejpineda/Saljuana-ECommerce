# 🏪 Saljuana-ECommerce 💸

Saljuana is a comprehensive e-commerce website built using the PHP Codeigniter framework. It provides a range of features for both users and administrators, enabling smooth and efficient online shopping experiences. This README.md file serves as a guide to understanding the project structure and functionality.

## Features

Saljuana encompasses a variety of features for users and administrators, making it a versatile e-commerce solution. The key features of the project include:

### User Features

- **User Authentication**: Secure user registration and login functionality.
- **Item Filtering with Ajax**: Filter products based on various attributes using asynchronous requests.
- **Advanced Filters**: Refine product searches using advanced filters such as price range, category, etc.
- **Rating System**: Users can rate products and provide feedback.
- **Comment System**: Users can leave comments and engage in discussions about products.
- **Order History**: Maintain a record of user orders for easy reference.
- **Quick Buy**: Simplify the purchasing process with a quick buy feature.
- **Stripe Integration**: Seamless integration of Stripe payment gateway for secure transactions.

### Admin Features

- **Product Management**: Add, edit, and update product information from the admin panel.
- **Order Management**: View a list of orders and track their status.
- **Order Details**: Access detailed information about a specific order.
- **Product Example**: Provide a sample product view for reference.
- **Seller Analytics**: Generate graphical statistics and insights to track seller performance.


## Usage and Installation

You can use composer or WAMP/XAMPP to host the PHP project.

For composer:

1. Clone the repository: git clone https://github.com/your-username/saljuana.git
2. Navigate to the project directory: cd saljuana
3. Install the dependencies: composer install
4. Configure the database connection in application/config/database.php
5. Run the database migrations: php index.php migrate
6. Serve the application using a local development server: php -S localhost:8000
7. Access the application in your browser at http://localhost:8000

For XAMPP/WAMP:

1. Setup your virtualhost and make the root directory of the project's folder for the XAMPP virtual host main '/'.
2. Access the virtualhost in the browser


## Contributing
Contributions to Saljuana are welcome! If you would like to contribute, please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bug fix: git checkout -b my-feature-branch
3. Make the necessary changes and commit your work: git commit -am 'Add new feature'
4. Push your changes to the branch: git push origin my-feature-branch
5. Submit a pull request with a detailed description of your changes.

## Screenshots

1. Landing Page
	- ![Screenshot (2)](https://github.com/ceejpineda/Saljuana-ECommerce/assets/57590361/c16b202d-175a-4efd-b94b-50897814e4f4)

2. Login/Registration
	- ![image](https://github.com/ceejpineda/Saljuana-ECommerce/assets/57590361/ec2e69e5-6e70-412a-b916-651edb717b53)

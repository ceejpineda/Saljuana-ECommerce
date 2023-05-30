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

### USER FEATURES

1. Landing Page
	- ![Screenshot (2)](https://github.com/ceejpineda/Saljuana-ECommerce/assets/57590361/c16b202d-175a-4efd-b94b-50897814e4f4)

2. Login/Registration
	- ![image](https://github.com/ceejpineda/Saljuana-ECommerce/assets/57590361/ec2e69e5-6e70-412a-b916-651edb717b53)

3. Main Shopping Screen
	- ![Screenshot (17)](https://github.com/ceejpineda/Saljuana-ECommerce/assets/57590361/d7b1f830-3f29-4bd3-8402-4acc2105a88b)

4. Advanced Filtering (Search and Checkboxes)
	- ![image](https://github.com/ceejpineda/Saljuana-ECommerce/assets/57590361/b512f8c0-0bc0-47fc-8f1f-1242359626a5)

5. Show Product and Related Items
	- ![image](https://github.com/ceejpineda/Saljuana-ECommerce/assets/57590361/0d04746d-791f-4730-b02d-1e4a2b4723f6)

6. Comment and Rating System
	- ![image](https://github.com/ceejpineda/Saljuana-ECommerce/assets/57590361/f8fd3b2b-a484-45f8-a473-db369853044e)

7. Checkout Page
	- ![image](https://github.com/ceejpineda/Saljuana-ECommerce/assets/57590361/282c4d6a-0a71-4f22-bd18-f6aea41013e3)

8. Stripe Payment System Integration Portal
	- ![image](https://github.com/ceejpineda/Saljuana-ECommerce/assets/57590361/ce3b7254-b0f8-4d04-aef5-2075173b83fe)

9. Success Page
	- ![image](https://github.com/ceejpineda/Saljuana-ECommerce/assets/57590361/de018a43-b5bb-48ca-9d19-30c3f6298d47)


### ADMIN FEATURES

1. Order Dashboard (Show all Orders) + Sort and Filter
	- ![image](https://github.com/ceejpineda/Saljuana-ECommerce/assets/57590361/ad3073cc-f1b2-44f5-8846-74b34ced0b2e)

2. Product Dashboard + Sort and Filter
	- ![image](https://github.com/ceejpineda/Saljuana-ECommerce/assets/57590361/fd4c4270-3fa0-4d08-bb16-fcae45206724)

3. Add new Products or Update Existing Product
	- ![image](https://github.com/ceejpineda/Saljuana-ECommerce/assets/57590361/159c902a-106d-47b1-98e7-b384f1d1d22e)

4. Preview new Product
	- ![image](https://github.com/ceejpineda/Saljuana-ECommerce/assets/57590361/448aa81e-2cba-4bff-9750-ab58b401dafc)

5. Seller Analytics
	- ![image](https://github.com/ceejpineda/Saljuana-ECommerce/assets/57590361/e5f0a96e-bbde-4695-85a4-f3b0f56d86db)

	- ![image](https://github.com/ceejpineda/Saljuana-ECommerce/assets/57590361/802d606a-a60a-4eaf-9241-4403e5ff4866)


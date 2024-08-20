# **Practical Assessment**
## **Lou Geh Manufacturing Company**
Lou Geh manufacturing company produces products. The following product information is stored: product name, product ID and quantity on hand. These products are made up of many components. Each component can be supplied by one or more suppliers. The following component information is kept: component ID, name, description, suppliers who supply them, and products in which they are used. 
-	A supplier can exist without providing components.
-	A component does not have to be associated with a supplier.
-	A component does not have to be associated with a product. Not all components are used in products.
-	A product cannot exist without components.

## **Task**
1. Create a prototype based on the attached problem
2. Technologies and design to be used are the following:
    * Backend -  PHP
    * Database - MySQL
    * Frontend - Basic HTML, CSS and Javascript
3. As for your application documentations you need to provide the ff:
   1. ERD
   2. DFD
4. Provide a ```README.md``` containing the setup guide.
5. The application should be published in Github via forked repository and for final version of your prototype will create a ```Pull request``` in Github 
6. You will send the Github link to us thru our email devops@biotechfarms.com on or before **23-08-2024** 12:00 PM


    ### **Directory structure**
    ```
    my-app/
    ├── configs                      (Config scripts)
    |   └── db.php
    ├── controllers                      (PHP Controller scripts)
    |   └── UserController.php
    ├── js/
    |   └── app.js                       (Javascript scripts)
    ├── css/
    |   └── style.css                    (CSS scripts)
    ├── index.html                       (Entry point)
    ├── documentation/                   (Documentation files and assessts)
    |   └── UserController.php
    └── README.md                        (Project documentation)
    ```
    ### **Submission format**
    - Repository should show codebase directory directly **DO NOT PUT YOUR CODE BASE IN A ZIP FILE** use git commands instead to push your code-base and further updates.
    - Prototype's latest version should be the default branch of the repository.
    - Provide a READ.ME file on how to install and deploy your prototype, and its prerequisite, software, sdk(if needed), and driver.

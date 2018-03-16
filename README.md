# php-ecommerce-project
Name :Heba Mamdouh Ali

/************************************************************************/

what you finished from the required features?
I finished all the required features


/************************************************************************/

what you finished from the bonus features?
I finished all the bonus features

/***********************************************************************/

/*****************************************  Home Page:  *******************************************************************/
The first page user access it ,there are three cases when access the home page

//The first case : [not login user access home page]
In this case the home page have:

1-two links one for login and the other for register a new account 

2-link called All to show all the products saved in the database for the user

3-each catagory saved in database has a link in the home page to show all products belong to this catagory

[ not login user can't access anything except the home page and view all products or the products of a certain catagory ]



//The second case:[logged in user (general user) access home page]
In this case the home page have :

1-Account link :  redirect to page that show all information about the login user. 

2-Checkout link :  redirect to page that show all products which the login user added them to cart and show the total price of these products.

3-logOut link : to logout the user from his/her current account.

4-input text for  search : to enable the login user to search for a certain product.

5-links to show the products filter by its catagory.

6-for each product shown in the home page there are some information about this product such as 
[product name ,product photo,the first 100 character of the product description ,product price ,the product average rate and finally add to cart button to enable for the user to add this product to his/her checkout list  ]

7-for each product shown in the home page ,there is link has the same name of product to redirect to page show the details information about the product 


//the third case:[logged in user (Admin)]
In this case the home page have the same previous links that exist in case of  the general logged in user 
inaddation to addProduct link to enable for the admin only to add a new product in database.

There are extra features dedicated only for admin such as in the page that view the details information about the product ,there are edit product button to enable for the admin to edit specific product in the database.
delete product button to enable for the admin to delete a certain product from the database.


/*****************************************  view product Page:  *******************************************************************/

The logged in user [general logged in user or admin] can access this page when click on the link has the same name of the product in the home page .

this page show the details information about the product such as 
[product name ,product photo,the full product description ,product price ,the product average rate and finally add to cart button to enable for the user to add this product to his/her checkout list  ].

this page also show all the users's reviews for that product [for each review has the name of user that written it ,the date of review and the review text content ].

the view product page include textarea to enable for users to leave reviews for the product and give a  rate for it (this part of page appear only for logged in user [general user ] not for the admin).



/******** note *******/

user can leave a review and rate for a specific product only one time , user can't write more than one review for a certain product .


/***************************************** Account page ***************************************************************************/

this page show all information about the logged in user and also there is a link called Edit profile to redirect to the page enable for the logged in user to edit his/her information.



/******************************************** checkout page *********************************************************************/

show all products that the user added them to cart and show the total price of them .
for each product in this list ,there is a delete button to remove a specific product from the check out list .


/******************************************* addproduct page *******************************************************************/
this page dedicated only for the admin to add a new product in database ,he insert the information about the new product in the form shown in this page and then submit the form to insert new product in database.



/******************************************* Editproduct page ********************************************************************/
this page dedicated only for the admin to edit the information of a certain product.













# magento-loyalty-discount
Offer discount for customers based on their lifetime orders


##Installation
1. Download as zip file. extract and copy app folder to your magento root folder
2. Go to Magento Admin panel, Refresh cache and check the system configuration page **NOTE:** Disable compilation if enabled
3. In the Left Panel, You can see a Tab called "Extensions From John" Where you can find Loyalty Discount Settings
4. Enable Loyalty Discount from that page and save configuration.
5. Goto Admin menu, Promotions > Shopping Cart Rules and Click on Add new Rule Button on that page
6. In this Add New Rule page, You can see a "Conditions" Tab on left side of the form. Click on that and try to add a condition
7. You can see an option called "Loyalty Discount"> Select that option.
8. After that you can set the value for "Minimum LifeTime Order Amount Required". If this minimum Amount is already spent by a Customer, SalesRule will consider this loyalty discount to that particular Customer on every order
9. set actions that need to be done if the condition is validated.
10.Save the New rule and make it active.

###### This Module will add a Loyalty discount automatically to the cart if the loggedin user is having a LifeTime Order Amount which is greater than or equal to "Minimum LifeTime Order Amount Required" specified in the rule.



This is a simple method for implementing custome Sales Rule condition without overwriting any core modules.


###### Please Feel free to contact me at johnpj4u@gmail.com




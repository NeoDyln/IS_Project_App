# IS_Project_App
 This is an Internal Social App that I created as part of my university requirements and as a practice program for myself.
 
## App Info

- Version: 0.1

## Features

The current features of the program include:

- Chat Functionality

This is basically an implementation of a chatting functionality where users will be able to converse with other users.

- Users Model

This is where users will be able to search for other users in the team and start a chat with them.

- Public Group Model

Here, users can be able to chat in a common public group with at least 3 users. All registered users are by default part of the common public group.

- Authentication Model

This will basically authenticate whether the user is who they claim to be. Since the system will be tied to an institution/ personal account, verification will only happen via the institution/ personal accounts.

## Guide

There are two steps to implementing this program. One is on the server side and one on the client side as follows:

### Server Configuration

 - Obtaining a web server

 The system is intended to run on a web server therefore to implement it, the administrator must first secure a web domain service provider. For instance, Hostinger (https://www.hostinger.com) and Hostgator (https://www.hostgator.com) offer hosting services for the application.

 - Choose a domain name

 One must create a domain name/ URL name via which the application will be searched on the internet. For instance, www.mysocialapp.org is an example of a URL the administrator can go for.

 - Upload system files

 Afterwards, the administrator must access the control panel (Most hosting services use cPanel) of the domain he/she/they created. There, the system files will be uploaded. These shall be provided via the system disk/ zip file.

 - Set database permissions

 Once done, the administrator shall head over to the database permissions tab of the hosting service chosen, create and grant permissions for the below user as follows:

     - username - > “<NAME of Choice>”

     - password - > “<Password of choice>”

 - Update system settings

 Once done, the administrator shall head over to the below locations in the uploaded files, open them using a text editor/ code editor and edit each of the fields as below.

    NOTE: ../ Stands for the root of the storage.

     - Location 1: ../php/serverConnector.php.

     - Location 2: ../php/chats/chatConnector.php

 For each location:

     $servername = “Enter your new URL e.g.: www.mysocialapp.org”;
     $username = “<Name of choice from previous step above>”
     $password = “<Password of choice given from previous step above>”;

 - Finishing touches

 After saving these changes, the system should be up and running if you decide to visit the URL. It is important to note that the hosting service is dependent on the service provider you chose. If you wish to have a default team, you can do so via the registration guide in the User Guide below.
 
 ### User Guide
 
This guide assumes you or an administrator has implemented the system on a server. If you can access the system from a web browser via a URL, then the system has been implemented and you can proceed below otherwise have your administrator follow the implementation guide above.

 - Getting started
 
On opening the URL, the below page(s) should load up depending on your device

![image](https://user-images.githubusercontent.com/42619900/162904594-5da49aa7-7b99-4525-b55f-5c807657d088.png) 
Homepage Desktop View

For desktop view, the above should display whereas for mobile view, the below should display.

![image](https://user-images.githubusercontent.com/42619900/162904720-a0a60493-3ee2-4be8-915a-7eb3213ad335.png) 
Homepage Mobile View

To use the system, a team must be created, and users must create an account associated with that team. If you’re an administrator and you’re straight from the implementation guide above or you wish to create a team, then proceed on to the ‘Registering a team’ section before continuing with this section. Otherwise, proceed to ‘Authentication’.

- Registering a team 

Click on the ‘Register my institution’ button on the homepage as shown above. A pop-up window should appear where you are to fill the details of the team, namely your team’s name, administrator, nickname/ initial and a URL to a website if the team has one.
The user interface should appear with the form and buttons below for either device that you use. Fill the fields out and submit via the Create button. 
If successful, the system will notify via an alert that it has been created. From here, the user can proceed to the ‘Authentication’ section

![image](https://user-images.githubusercontent.com/42619900/162904845-3d77aee3-559d-4eae-b76f-6f6d7629ab57.png)
Registration Form

5.3.3:	Authentication
This is accessed through the ‘Get Started’ button. On click, the below page will pop up:

![image](https://user-images.githubusercontent.com/42619900/162904919-a345d287-444e-46c9-9c3d-2668e7c574c4.png) 
Auth Screen

From this page, the default loaded option would be the reset password form as shown above therefore be sure to select the option you wish to use (Login/ create an account/ Reset Password) from the bottom left options under ‘What would you like to do’.

If it’s your first time using the system, especially in a new team, it is mandatory to create an account, else a ‘User does not exist’ error will appear.
Select the option you wish to use and on click, the bottom right form will change appropriately.

For each form option, you must select the team to which you would like to interact with via the dropdown field. Afterwards, you fill out the form and click the submit button (Note: Some forms need you to scroll down to see other fields as well as the submit button).

For now, this guide shall assume you have just created an account or logged into an existing account and on submission, the page should notify of a successful registration after which it redirects to a new page. This will be the ‘Chat Screen’ as seen in the Chats Section below.

- Chats
On redirection from the authentication page, the below should appear:

![image](https://user-images.githubusercontent.com/42619900/162905071-b534ae65-98b2-44a4-b65a-81d625b1b923.png)
Messaging screen

On the top left, a short welcome message will be displayed and alongside it will be the team’s name as well as the name of the currently logged in user. To the far top right will be the log out option which terminates the session of a logged in user.

Below the header section will be two divisions. The first will be for peer-to-peer chats while the second division will be for group chats. By default, all members of a team are added to a public group which will take the name of the team.

•	Peer to peer chatting

To start a chat, one must go to the chat search bar (The bar with the ‘find a user’ placeholder) to find other existing users. One cannot chat with themselves therefore there has to be at least two users registered in the system for a chat to begin.
One can search via their name or email address and a matching result will be displayed on a list. Once you select your desired chat, click on the ‘Start Chat’ button beside it to create the chat. The chat shall be listed as a new entry as shown below where the ‘You don’t have other chats’ option appears.

![image](https://user-images.githubusercontent.com/42619900/162905268-0d6d1d50-6ce1-42bb-9359-eee79b436237.png)
Sample Chat created

One can then click the chat button beside a particular user to open the messaging screen. It shall appear as below:
To exit a chat, simply click the exit button on the top right.
To send a new message, enter text in the text field at the bottom of the page and click send when done.
Messages from the sender will appear on the right together with the date it was sent

![image](https://user-images.githubusercontent.com/42619900/162905331-c007bc77-5f55-4745-b0fe-b163be73ca26.png)
Messaging screen view

•	Group Chat
Like peer chats, the group chat is opened via the chat button aside a particular group as shown below:

![image](https://user-images.githubusercontent.com/42619900/162905580-e3c43f9c-99a5-4eac-9aa9-4e54015a0a08.png)
Group Chat division

On opening, the message layout will load and just like the peer chats, messages from the logged in user appear on the right while those from other group members appear on the left. 
To exit the group messaging screen, press exit on the top right of the screen. To send a message, use the options at the bottom of the screen as well.
NOTE: Unlike the peer chats, group messages have the sender’s email listed beneath the message for ease of identifying who sent the message. A sample screen has been shown below:
Currently, only the public group chat can be implemented. Individual group creation capabilities will be added later.

![image](https://user-images.githubusercontent.com/42619900/162905667-59e965e5-1058-4b01-a6c4-b50bcf502844.png)
Group chat messaging screen

Currently these are the only applicable guides to use the system based on existing functionality. Should there be updates, they shall be uploaded to the GitHub repository (https://github.com/NeoDyln/IS_Project_App)
Administrator roles currently do not exist as the functionalities are evenly distributed to all users of the system. Administrator independent roles shall be added at a later version of the system. 

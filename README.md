# Lost and Found Web Application

## Overview

The Lost and Found Web Application is designed to help users report and find lost or found items, primarily in a school environment. Users can register, post details about lost or found items, and communicate with other users to return or recover these items. The application provides a simple and intuitive interface to manage lost and found items, making it easier for users to connect and resolve such situations.

## Features

### Homepage
- The homepage is the first screen displayed when a user opens the web application.
- It features a list of all items reported as either lost or found.
- Users can navigate through the menu and use the "Post a Found" and "Post a Lost" buttons on the horizontal navigation bar to report found or lost items.

### User Authentication

#### New User Sign-Up
- Users can register using their school email and a new password.
- This registration process ensures that only authenticated users can report or interact with items.

### Adding Items

#### Add Lost Item
- Users can report a lost or missing item by filling out a form with their name, phone number, and a brief description of the item.
- Users can upload a photo of the item and use a "Choose Location" button to get their current location.
- The form is fully validated to ensure all required information is provided before submission.

#### Add Found Item
- Similar to the Add Lost Item page, users can report found items by providing their contact details and a description of the found item.
- Users can upload an image of the item and submit the report through the application.

### Viewing Items

#### Lost Item Page
- This page displays all the items reported as lost.

#### Found Item Page
- This page displays all the items reported as found.

### User Profile

#### Profile Page
- The profile page displays the user's details, such as their name, email, and profile picture.
- Users can view a list of the lost and found items they have posted and have the option to delete them.

### Item Details

#### Details of Lost Items
- This page provides detailed information about a specific lost item.
- Other users can view the item's description and contact the person who made the report.
- Users can use various tools to communicate, such as:
  - **Call Button**: Initiates a phone call to the person who reported the item.
  - **Messaging Button**: Allows users to send a text message.
  - **Chat Button**: Opens an inbuilt messaging platform within the application.
  - **GPS**: Displays the location where the item was reported missing using Google Maps.

## Technology Stack

- **Frontend**: HTML, CSS, Bootstrap, JavaScript
- **Backend**: Laravel, JavaScript, PHP
- **Database**: MySQL
- **APIs**: Google Maps API for location services

## Getting Started

### Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/joyelere/lost_found.git

## Usage

- **Homepage**: View all reported lost and found items.
- **Sign Up**: Register as a new user with your school email.
- **Add Lost Item**: Report a lost item by providing relevant details.
- **Add Found Item**: Report a found item by uploading a picture and description.
- **View Items**: Browse through all reported lost and found items.
- **Profile Management**: View your profile and manage your posted items.



## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

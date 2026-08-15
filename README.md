# TravelSaathi

TravelSaathi is an AI-powered travel planning website built as a Software Engineering project. It helps travelers compare tour packages, generate personalized itineraries, and book trips — all from one platform.

## Overview

The platform aims to make trip planning easier by bringing all essential travel information together in one place. Using AI, users can input their preferences and get a customized itinerary that suits their needs. It also lets users browse and compare travel packages offered by different tour companies before booking.

## Features

- **User Registration & Profiles** – Sign up, log in, and manage personal travel preferences and history
- **AI-Powered Itinerary Generation** – Get a personalized travel itinerary based on your preferences (generated in under 5 seconds)
- **Search & Compare Tour Packages** – Browse packages from multiple tour companies and compare pricing, duration, and activities
- **Booking & Payments** – Book flights, hotels, and activities directly through the platform with booking confirmation and tracking
- **Wishlist / My Trips** – Save and manage favorite destinations and upcoming trips
- **Tour Company Dashboard** – Tour operators can publish and manage their own packages and discounts
- **Admin Dashboard** – Admins manage destinations, packages, users, and platform data
- **Blogs & Vlogs / Events** – Discover travel-related content and upcoming events

## Tech Stack

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL
- **Server Environment:** XAMPP
- **Other:** Third-party APIs for travel data, payment gateway integration

## User Roles

- **Tourist** – Platform user looking to plan and book travel
- **Tour Company/Provider** – Organization that lists and sells travel packages
- **Admin** – Manages and maintains platform data and users

## Getting Started

### Prerequisites

- [XAMPP](https://www.apachefriends.org/) (or any Apache + PHP + MySQL stack)
- A web browser (Chrome recommended)

### Installation

1. Clone the repository
   ```bash
   git clone https://github.com/RiyaSingla08/TravelSaathi.git
   ```
2. Move the project folder into your XAMPP `htdocs` directory
3. Start **Apache** and **MySQL** from the XAMPP control panel
4. Import the provided database schema (`.sql` file) into MySQL via phpMyAdmin
5. Update `db_connect.php` with your local database credentials
6. Open your browser and go to:
   ```
   http://localhost/TravelSaathi
   ```

## Project Team

This project was developed as part of the B.Sc. (H) Computer Science curriculum at Shyama Prasad Mukherji College for Women, University of Delhi, under the guidance of **Mr. Lavkush Gupta** (Project Guide).

**Contributors:**
- Riya
- Manasvi Arora
- Archi Aggarwal
- Alankriti Jain

## Non-Functional Highlights

- **Reliability:** Core features like package listings stay accurate and up-to-date
- **Availability:** Accessible 24/7
- **Security:** Access restricted to users with valid credentials
- **Portability:** Mobile-accessible, cross-browser compatible

## License

This project was developed for academic purposes.

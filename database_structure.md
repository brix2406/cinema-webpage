# Database structure overview
## Tables:
### users
    - userId – type=int AUTO-INCREMENT (PRIMARY KEY)
    - name – type=string
    - email – type=string
    - password – type=string
### movies
    - movieId – type=int AUTO-INCREMENT (PRIMARY KEY)
    - title – type=string
    - genre – type=string
    - description – type=string
    - lastScreening – type=date
    - trailerLink – type=string
    - posterPath – type=string
### screeningRooms
    - roomId – type=int AUTO-INCREMENT (PRIMARY KEY)
    - noOfSeats – type=int
### screenings
    - screeningId – type=int AUTO-INCREMENT (PRIMARY KEY)
    - movieId – type=int (foreign key referencing movies.movieId)
    - startDate – type=date
    - startTime – type=time
### bookings
    - bookingId – type=int AUTO-INCREMENT (PRIMARY KEY)
    - userId – type=int (foreign key referencing users.userId)
    - screeningId – type=int (foreign key referencing screenings.screeningId)
    - noOfTickets – type=int
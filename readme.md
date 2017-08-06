# TicketBeast application
`Tdd course created by Adam Wethan`

Application`s main goal is to allow visitors of site to purchase tickets
on different concerts available in the system.

## Features

- Inviting promouters
- Creating accounts
- Logging in as a promouter
- Adding concerts
- Editing concerts
- Publishing concerts
- Intergrating with stripe Connect to do direct payouts
- Purchasing tickets

## What should we test first?

- Purchasing tickets
    - View the concert listing
        + Allowing people to view published concerts
        + Not allowing people to view unpublished concerts
    - Pay for the tickets
    - View their purchased tickets in the browser
    - Send an email confirmation w/a link back to the tickets
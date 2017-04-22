## Intro
NOTE: this is the actual project/scripts to deal with the tasks.

A simple php script (with Guzzle http and promise) to simulate:
1. Create a mailchimp list.
2. Add a new member to this list.
3. Update that member's status to 'unsubscribed'.

## Run
1. git clone this project.
2. php create_list_member_update.php
3. It will output the list id, member id and print out the member obj, after it is updated.

Clean all existing list
1. php delete_all_lists.php

## /test directory
I play around some code there.

## Bonus
https://github.com/kenpeter/test_async_await
This repository is doing the same thing. It uses node 7, async, await.It is so much easier doing this way.

You can log in with kyle@omahawesternbowl.com as the username and the password 591736


The project is web based and also hosted at https://csci4850.kjl.xyz


Tiggers, are part of the database itself you can not delete a bowler if they are part of a team, also you may not delete a team if its part of a league.
I am not really sure how to show you the trigger portion of the code.  I'll ask in class on Tuesday.

--HOW TO RUN CODE--

The PHP connects to a remote DB so there is no action required on your part.  All you need to do is go to the index and it will redirect you to the log in page.  You can also run it by visiting the URL above.

TRIGGERS:


delimiter |

CREATE TRIGGER bowlerDelete BEFORE DELETE ON Bowler
  FOR EACH ROW
  BEGIN
    DELETE * FROM BowlerTeamLink WHERE ID = NEW.ID;
  END;
|



delimiter |

CREATE TRIGGER TeamDelete BEFORE DELETE ON Team
  FOR EACH ROW
  BEGIN
    DELETE * FROM LeagueTeamLink WHERE ID = NEW.ID;
  END;
|

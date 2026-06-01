<b>Code base to create your own in-house version of the New York Times's game "Connections"!</b>

This game involves grouping 16 words into 4 groups of 4 words.

<img width="600" height="369.564" alt="image" src="https://github.com/user-attachments/assets/13c8e7a0-7cf4-45a2-842b-bc1c51334db7" />

--------------------------------
This code base allows you to customize experiment variables such as the number of connection puzzles (default is 1 practice puzzle and 6 scored puzzles), the number of attempts granted for each puzzle (default is 6), and provides the materials to make your own puzzle tiles.

--------------------------------
<b>How to use</b>
1. <i>"CreateSQLdatabase.m"</i>. First, you will need to create a SQL database with randomized puzzle orders and tile orders within each puzzle. We have used ionos.com to host experiments (including their SQL databases) and recommend it!

2. <i>"stim_connectionsclean.php"</i>. This script will randomly select a row from your SQL database containing randomized puzzle and tile orders when a user plays the game.

3. <i>"connectionsexp_clean.html"</i>. The experiment (or "game") code! This is where variables to customize the game, such as the number of puzzles, are.

4. <i>"processdata_connectionsclean.php"</i>. Lastly, this script saves the variables (i.e., performance metrics like accuracy and reaction time) from the game to your database.

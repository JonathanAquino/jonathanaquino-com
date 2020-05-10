<?php
$cards = array(
    'Use your senses!' => 'Consider all five senses when designing (touch, taste, sight, hearing, smell). Aim for a full-on sensory experience, not just visual. You\'ll evoke a powerful emotional response.',
    'Ask "what if...?"' => 'Discover new visual possibilities by asking yourself, "what if...?" For example, "What if humans grew like flowers?" Combining unexpected elements often produces exciting visual effects.',
    'Sleep on it' => 'Work on a problem before going to sleep. Then, while you\'re snoozing, your subconscious takes over. What did your dreams tell you?',
    'Act childish' => 'Think like a child to enhance your creativity. How would a 5-year-old see your project? Let your creativity run wild and worry about the adult details later.',
    'Reconsider the old' => 'Redesign something you see all the time (a stop sign, a penny, etc.). This forces you to look at old things in a new way-and challenges you to try different design approaches.',
    'Tell a tall tale' => 'Imagine things bigger, faster, higher, brighter than they actually are. Try exaggerating specific features or sections of your design elements.',
    'What happens?' => 'Ask "how would they do it?" Choose a person who inspires you. How would that person solve your creative problem? How might he/she approach your project?',
    'Change viewpoints' => 'To get a fresh perspective, look at your work from a new standpoint. Check out your design in the mirror. Turn it upside down. What do you notice?',
    'Pick a word' => 'Grab the closest book to you. What\'s the first word you see? How does it relate to what you\'re doing? What associations can you make?',
    'Look elsewhere' => 'Anyone can find fashion in a boutique or art in a museum. Challenge yourself to discover new places for creative inspiration. Become a creative explorer!',
    'Be inquisitive' => 'Why are things the way they are? Don\'t accept the way things are, instead, wonder how things could be done differently or better. Learn to question all that is around you!',
    'Discover what works for you' => 'When you feel creative, take note of what you\'re doing. Are you listening to music? Are you alone or with people? Recreate these conditions when you need to get your creative juices flowing.',
    'Shake your habits' => 'Routine is the enemy of creativity. Challenge yourself to get out of your rut and dare to do things a little differently. Rearrange your office or have lunch with a different person today.',
    'Think in opposites' => 'Want your design to generate excitement? Imagine how to make it as boring as possible. Think in opposites to spark ideas, put you in a fun mindset, and destroy your creative roadblock.',
    'Buy-in made easy' => 'When designing, try to use at least one of your client\'s suggestions. Whether it\'s a color, theme, or image they recommended. If the suggestion was great, mention it when presenting your work.',
    'Break the rules' => 'Drop assumptions. And stir up reality a bit. Does the head always have to be on top of the body? How might breaking the rules impact your designs?',
    'Brainstorm!' => 'Bouncing ideas off other people can generate new design concepts and solutions. But don\'t edit ideas too soon. Remember: even the "silliest" of ideas can blossom into something genius.',
    'Make free associations' => 'Think of your concept or project. Now write down any words that pop into your mind. Think size, color, shape, location. Where do these words lead you? How can they improve your idea?',
    'Look to nature' => 'Let nature be your guide to creative problem solving. For example, how might you get over your creative barrier if your were an ant? You\'d likely turn to teamwork and get the job done.',
    'Write it down!' => 'Ideas can come to you anywhere, at any time. Carry a notebook so you can always make a record of them. Best of all, when you\'re in need of a great idea, you know exactly where to look.');
$images = array('thumb_1740.png', 'thumb_1829.png', 'thumb_2472.png', 'thumb_2474.png', 'thumb_2516.png', 'thumb_2525.png', 'thumb_2660.png', 'thumb_2704.png', 'thumb_2705.png', 'thumb_2716.png', 'thumb_2717.png', 'thumb_2719.png', 'thumb_2720.png', 'thumb_2736.png', 'thumb_2738.png', 'thumb_3521.png', 'thumb_3611.png', 'thumb_3612.png', 'thumb_3613.png', 'thumb_3614.png', 'thumb_3670.png', 'thumb_3674.png');
$imageIndex = mt_rand(0, count($images)-1);
$cardIndex = mt_rand(0, count($cards)-1);
$titles = array_keys($cards);
$descriptions = array_values($cards);
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>EyeWire Creativity Cards</title>
    <link rel="stylesheet" href="http://yui.yahooapis.com/2.6.0/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
    <style>
        html {
            font-size: 62.5%;
            background: url(eyewire/<?php echo $images[$imageIndex] ?>)
        }
        h1 {
            font: bold 34px "Century Schoolbook", Georgia, Times, serif;
            color: #333;
            letter-spacing: -2px;
        }
        #bd {
            font-weight: normal;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 28px;
            letter-spacing: -1px;
            line-height: 24px;
        }
        #doc {
            background-color: #fff;
            margin-top: 2em;
            padding: 1em;
        }
        #ft {
            margin-top: 2em;
            font-family: "Lucida Grande",Verdana,Arial,Helvetica,sans-serif;
            font-size:11px;
        }
        #ft, #ft a:link, #ft a:visited, #ft a:hover, #ft a:active {
            color: #AAA;
        }
        cite {
            float: right;
        }
    </style>
</head>
<body>
<div id="doc" class="yui-t7">
    <div id="hd"><h1><?php echo $titles[$cardIndex]; ?></h1></div>
    <div id="bd">
        <div class="yui-g"><?php echo $descriptions[$cardIndex]; ?></div>
    </div>
    <div id="ft">
        <a href="/eyewire.php">Refresh</a>
        <cite>Text from <a href="http://www.innovationtools.com/pdf/eyewire_cards.pdf">Eyewire Creativity Cards</a>. Background from <a href="http://www.stripegenerator.com">Stripe Generator</a>.</cite>
    </div>
</div>
</body>
</html>

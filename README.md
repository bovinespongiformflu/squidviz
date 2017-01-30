# SquidViz: Cluster Visualizer

Oh hi!  I didn't see you there.  How are you?  Good!  SquidViz, yeah?

So SquidViz is a web-based visualizer for Ceph clusters, designed to help developers and new users understand how Ceph works.  It is based on D3.js, weaving together code that was originally part of three of D3's examples.

There's a server-side piece that grabs info from Ceph (using "ceph osd tree" and "ceph pg dump", both with --format=json) and rebuilds the JSON so that it's in the hierarchical form that D3 wants.  Then, through a ridiculous collection of iframes and javascript hacks, it comes alive with updates on your cluster health.

## Wat SquidViz it is?

SquidViz is a great way for visual learners to understand how Ceph reacts to change.  When OSDs go down, you can see how Ceph degrades PGs accordingly.  When new pools are created, you can see how the cluster allocates PGs.  When moving data in and out of the cluster, you can see a running iops sparkline.

The Physical tree does not update automatically so there's a refresh button.  The Logical tree *does* update automatically; you will soon realize, once you get to know it, that this is a feature that you will want to turn off from time to time.  That's what the checkbox does.

There's a hidden terminal window (hint: click on the red "squidviz" in the header) and a hidden PG state legend (hint: click on "LOGICAL").  These are collapsed by default to keep things tidy, as SquidViz was originally built for demo purposes.

Check out this video of [SquidViz in action](http://objects.dreamhost.com/rossturk/squidviz.mov).

## Wat SquidViz it is not?

This was built as a demonstration and learning tool.  As such, there are a few things that SquidViz particularly is *not*.

SquidViz is not a full-featured Ceph admininstration or monitoring system.  A real management tool would scale beyond a dozen or so OSDs (or beyond a thousand or so PGs), while this one will not.  A real management tool would also dynamically update, while this one relies on refreshing iframes.  In short, anyone doing real work with Ceph should outgrow this almost immediately.

SquidViz is not part of the Ceph Project.

SquidViz is not an Inktank product.

## Installation

First, make sure that your machine has the right ceph.conf and client keyring. Then:

### Install Apache and PHP

You will need a webserver with PHP for the server-side pieces.

	apt-get install apache2 libapache2-mod-php

### Add to document root

Move the squidviz dir into your document root (often /var/www).

	mv squidviz/ /var/www

Make sure Ceph is installed and the keys are in the correct locations to run 'ceph status' and such.
Original software created by Ross Turk. https://github.com/rossturk/squidviz
Updated to work with Jewel+
# squidviz

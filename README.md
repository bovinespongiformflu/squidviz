# SquidViz: Cluster Visualizer

So SquidViz is a web-based visualizer for Ceph clusters, designed to help developers and new users understand how Ceph works.  It is based on D3.js, weaving together code that was originally part of three of D3's examples.

There's a server-side piece that grabs info from Ceph (using "ceph osd tree" and "ceph pg dump", both with --format=json) and rebuilds the JSON so that it's in the hierarchical form that D3 wants.  Then, through a ridiculous collection of iframes and javascript hacks, it comes alive with updates on your cluster health.

## Wat SquidViz it is?

SquidViz is a great way for visual learners to understand how Ceph reacts to change.  When OSDs go down, you can see how Ceph degrades PGs accordingly.  When new pools are created, you can see how the cluster allocates PGs.  When moving data in and out of the cluster, you can see a running iops sparkline.

The Physical tree does not update automatically so there's a refresh button.  The Logical tree *does* update automatically; you will soon realize, once you get to know it, that this is a feature that you will want to turn off from time to time.  That's what the checkbox does.

Thereis  a hidden PG state legend (hint: click on "LOGICAL"). It is collapsed by default to keep things tidy.

## Wat SquidViz it is not?

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
This software is being worked in a way which allows it's use on large scale ceph clusters
Updated to work with Jewel+

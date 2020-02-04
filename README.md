# Wordpress-Rest-API-Model

If you’ve been around the WordPress space for awhile, you’ve probably heard of the WordPress REST API. If you’ve done any research, you may have been really intimidated by what you found — namely, a LOT of technical jargon and seemingly no clear path on how to actually use it.

Today I’m going to show you (the absolute beginner) how to use the WordPress REST API. First, I’ll show you how to get some data from another WordPress site. Then, I’ll introduce a few key terms once you see how it works.

Before we begin, open up Chrome and install the JSON Viewer extension. When you try the examples below, the output will be presented in a much more readable format.

Using the WordPress REST API
To use the WordPress REST API, simply add /wp-json/wp/v2/posts to the end of your WordPress site URL. This will give you a list of posts (in JSON format). The default number of posts returned is 10, but you can choose to show more or less with the per_page argument — we’ll talk about that below.

For example, visit https://renemorozowich.com/wp-json/wp/v2/posts. You did it! You just used the WordPress REST API to view my 10 post recent posts. Easy, right?

Arguments to Return Specific Posts
There are also several arguments you can append to get specific posts.

per_page will let you specify how many results you want to return. Here I’m searching for the two most recent blog posts: https://renemorozowich.com/wp-json/wp/v2/posts?per_page=2

order will let you specify how to return the results, in order descending (default) or ascending. Here I’m searching for my blog posts in ascending order: https://renemorozowich.com/wp-json/wp/v2/posts?order=asc

categories will show you posts from a specific category. (You have to know the ID, which you can find if you add /wp-json/wp/v2/categories to the end of your main URL.) Here I’m searching for posts in the Technical category (ID 33): https://renemorozowich.com/wp-json/wp/v2/posts?categories=33

search will show posts that include a specific search phrase. Here I’m searching all of my posts for the word plugin: https://renemorozowich.com/wp-json/wp/v2/posts?=search[plugin]

An Example Using the REST API
I wrote a little plugin to get the two post recent posts from Sumy Designs, a web design company in Indiana. The post name, date and permalink are returned.

Here is the output:

How to Embed YouTube Video in WordPress 2/3/2020
WordPress Document Management 1/30/2020
If you visit this page again in a few days, you’ll see that the posts will have changed. The REST API is getting the two most recent posts, which will change each time they publish a new post.


<h2><a href="https://renemorozowich.com/using-wordpress-rest-api-get-blogs/">Here is the link to all code</a><h2/>

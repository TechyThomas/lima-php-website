# About Lima

### Contents

- [Why create another MVC framework?](#why-create-another-mvc-framework)
- [Whats included in the base?](#whats-included-in-the-base)
- [Can I extend or add to the core?](#can-i-extend-or-add-to-the-core)
- [Can I make suggestions or report bugs?](#can-i-make-suggestions-or-report-bugs)

<a id="why-create-another-mvc-framework"></a>
### Why create another MVC framework?

Simple, because I wanted to. I know there are plethora of MVC based frameworks out there, the biggest name probably being Laravel. Another you may or may not have heard of is CodeIgniter. I've coded in both of these frameworks and still deal heavily with Laravel in my day job. I wanted to take the premise of both of those and really compact it down.

Since my early days of PHP, I've been fascinated by the MVC pattern. After building my first major PHP project using that architecture, its totally matched with the way I think about code and I've used it ever since. It massively speeds up development in my projects.

My goal with Lima was build a simple, but powerful foundation of an MVC framework that can be used in any way, shape or form. One key aspect that was super important to me was to have as few dependencies as possible, ideally zero. I've managed to achieve that with the only required package being the dotenv package. Honestly, it just makes loading environment variables so easy and is really a must for any major PHP project in my opinion. Why reinvent the wheel there?

<a id="whats-included-in-the-base"></a>
### Whats included in the base?

I wanted to include a core feature set that would be at heart of any major PHP project. Something I'm sure we all would rather not have to setup every time we start a new project! The core features of Lima are:

- MySQL database connectivity
- Query builder based around PDO and prepared statements
- Controller system
- Model system
- Routing system
- Template rendering (with Twig support)
- Input validation

The rest is up to you! I've got the ball rolling, its up to you to direct it and decide where it goes.

<a id="can-i-extend-or-add-to-the-core"></a>
### Can I extend or add to the core?

Absolutely! I've intended for any of the core classes to be extended upon. I've even done this myself in my own projects. Need to hide everything behind user authentication? Then simply extend the Controller class and apply your auth logic on any request. The world is your oyster as they say.

<a id="can-i-make-suggestions-or-report-bugs"></a>
### Can I make suggestions or report bugs?

Please do! I'm always looking for ways to improve not just this framework, but also the code I do and the way I develop projects. I'd love to know how you use Lima, any sticking points, and anything you may think could even be a good idea to include into the core.

The GitHub repo is public so please report all bugs, issues and suggestions there. [GitHub Repo](https://github.com/TechyThomas/lima-mvc)

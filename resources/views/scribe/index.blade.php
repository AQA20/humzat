<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://humzat.local";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.3.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.3.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-auth" class="tocify-header">
                <li class="tocify-item level-1" data-unique="auth">
                    <a href="#auth">Auth</a>
                </li>
                                    <ul id="tocify-subheader-auth" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="auth-POSTapi-login">
                                <a href="#auth-POSTapi-login">Handle user login and return auth token.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="auth-POSTapi-logout">
                                <a href="#auth-POSTapi-logout">Log out the authenticated user by deleting their current access token.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-authentication" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authentication">
                    <a href="#authentication">Authentication</a>
                </li>
                                    <ul id="tocify-subheader-authentication" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="authentication-POSTapi-register">
                                <a href="#authentication-POSTapi-register">Register a new user (or return existing) and issue auth token.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-block-routes" class="tocify-header">
                <li class="tocify-item level-1" data-unique="block-routes">
                    <a href="#block-routes">Block Routes</a>
                </li>
                                    <ul id="tocify-subheader-block-routes" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="block-routes-POSTapi-users--user_id--block">
                                <a href="#block-routes-POSTapi-users--user_id--block">Block a user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="block-routes-DELETEapi-users--user_id--block">
                                <a href="#block-routes-DELETEapi-users--user_id--block">Unblock a user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="block-routes-GETapi-users-blocked">
                                <a href="#block-routes-GETapi-users-blocked">List users you have blocked</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-comment-routes" class="tocify-header">
                <li class="tocify-item level-1" data-unique="comment-routes">
                    <a href="#comment-routes">Comment Routes</a>
                </li>
                                    <ul id="tocify-subheader-comment-routes" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="comment-routes-GETapi-comments">
                                <a href="#comment-routes-GETapi-comments">Display a paginated list of top-level comments with their replies.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="comment-routes-GETapi-comments--id-">
                                <a href="#comment-routes-GETapi-comments--id-">Display a specific comment along with its replies.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="comment-routes-POSTapi-comments">
                                <a href="#comment-routes-POSTapi-comments">Store a newly created comment.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="comment-routes-PUTapi-comments--id-">
                                <a href="#comment-routes-PUTapi-comments--id-">Update a comment if the authenticated user is the owner.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="comment-routes-DELETEapi-comments--id-">
                                <a href="#comment-routes-DELETEapi-comments--id-">Delete a comment.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-GETapi-me">
                                <a href="#endpoints-GETapi-me">GET api/me</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-hashtag-routes" class="tocify-header">
                <li class="tocify-item level-1" data-unique="hashtag-routes">
                    <a href="#hashtag-routes">Hashtag Routes</a>
                </li>
                                    <ul id="tocify-subheader-hashtag-routes" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="hashtag-routes-GETapi-hashtags">
                                <a href="#hashtag-routes-GETapi-hashtags">Display a paginated list of hashtags with the count of related posts.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="hashtag-routes-GETapi-hashtags--id-">
                                <a href="#hashtag-routes-GETapi-hashtags--id-">Display the specified hashtag along with its related posts (paginated).</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="hashtag-routes-GETapi-hashtags-by-name--name-">
                                <a href="#hashtag-routes-GETapi-hashtags-by-name--name-">Get the specified hashtag by its name, along with its related posts (paginated).</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-media-routes" class="tocify-header">
                <li class="tocify-item level-1" data-unique="media-routes">
                    <a href="#media-routes">Media Routes</a>
                </li>
                                    <ul id="tocify-subheader-media-routes" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="media-routes-GETapi-media--media_id-">
                                <a href="#media-routes-GETapi-media--media_id-">Display the specified media resource.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="media-routes-POSTapi-media">
                                <a href="#media-routes-POSTapi-media">Store a newly uploaded image and create media record.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="media-routes-DELETEapi-media--media_id-">
                                <a href="#media-routes-DELETEapi-media--media_id-">Delete the specified media resource.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-post-routes" class="tocify-header">
                <li class="tocify-item level-1" data-unique="post-routes">
                    <a href="#post-routes">Post Routes</a>
                </li>
                                    <ul id="tocify-subheader-post-routes" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="post-routes-GETapi-posts">
                                <a href="#post-routes-GETapi-posts">Display a paginated list of posts with related data.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="post-routes-GETapi-posts--id-">
                                <a href="#post-routes-GETapi-posts--id-">Display a single post by ID.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="post-routes-POSTapi-posts--post_id--share">
                                <a href="#post-routes-POSTapi-posts--post_id--share">Increment the post share count.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="post-routes-POSTapi-posts">
                                <a href="#post-routes-POSTapi-posts">Store a newly created post.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="post-routes-PUTapi-posts--id-">
                                <a href="#post-routes-PUTapi-posts--id-">Update the specified post.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="post-routes-DELETEapi-posts--id-">
                                <a href="#post-routes-DELETEapi-posts--id-">Delete the specified post.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-user-routes" class="tocify-header">
                <li class="tocify-item level-1" data-unique="user-routes">
                    <a href="#user-routes">User Routes</a>
                </li>
                                    <ul id="tocify-subheader-user-routes" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="user-routes-GETapi-users--user_id-">
                                <a href="#user-routes-GETapi-users--user_id-">Show public profile of the specified user.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-routes-GETapi-users--user_id--posts">
                                <a href="#user-routes-GETapi-users--user_id--posts">Get paginated posts created by the specified user.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-routes-GETapi-users--user_id--comments">
                                <a href="#user-routes-GETapi-users--user_id--comments">Get paginated comments made by the specified user.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-routes-POSTapi-users-profile-picture">
                                <a href="#user-routes-POSTapi-users-profile-picture">Upload or update the authenticated user's profile picture.</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: August 2, 2025</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://humzat.local</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="auth">Auth</h1>

    

                                <h2 id="auth-POSTapi-login">Handle user login and return auth token.</h2>

<p>
</p>



<span id="example-requests-POSTapi-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://humzat.local/api/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"qkunze@example.com\",
    \"password\": \"consequatur\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "qkunze@example.com",
    "password": "consequatur"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-login">
</span>
<span id="execution-results-POSTapi-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-login" data-method="POST"
      data-path="api/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-login"
                    onclick="tryItOut('POSTapi-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-login"
                    onclick="cancelTryOut('POSTapi-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-login"
               value="qkunze@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>qkunze@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-login"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
        </form>

                    <h2 id="auth-POSTapi-logout">Log out the authenticated user by deleting their current access token.</h2>

<p>
</p>



<span id="example-requests-POSTapi-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://humzat.local/api/logout" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/logout"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-logout">
</span>
<span id="execution-results-POSTapi-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-logout" data-method="POST"
      data-path="api/logout"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-logout"
                    onclick="tryItOut('POSTapi-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-logout"
                    onclick="cancelTryOut('POSTapi-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="authentication">Authentication</h1>

    

                                <h2 id="authentication-POSTapi-register">Register a new user (or return existing) and issue auth token.</h2>

<p>
</p>

<p>Registers a user with the provided email, username, and password.
If a user with the same email or username already exists, the existing user is returned.
Returns a new authentication token either way.</p>

<span id="example-requests-POSTapi-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://humzat.local/api/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"username\": \"johndoe\",
    \"email\": \"john@example.com\",
    \"password\": \"secret123\",
    \"name\": \"hdtqtqxbajwbpilpmufin\",
    \"bio\": \"llwloauydlsmsjuryvojc\",
    \"password_confirmation\": \"secret123\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "username": "johndoe",
    "email": "john@example.com",
    "password": "secret123",
    "name": "hdtqtqxbajwbpilpmufin",
    "bio": "llwloauydlsmsjuryvojc",
    "password_confirmation": "secret123"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-register">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;user&quot;: {
        &quot;id&quot;: &quot;01986aab-55e5-7089-ad78-e92294877610&quot;,
        &quot;username&quot;: &quot;johndoe&quot;,
        &quot;name&quot;: null,
        &quot;bio&quot;: null,
        &quot;profile_picture_url&quot;: null,
        &quot;created_at&quot;: &quot;2025-08-02T12:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-08-02T12:00:00.000000Z&quot;,
        &quot;email&quot;: &quot;john@example.com&quot;
    },
    &quot;token&quot;: &quot;1|abcd1234...&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-register" data-method="POST"
      data-path="api/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-register"
                    onclick="tryItOut('POSTapi-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-register"
                    onclick="cancelTryOut('POSTapi-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>username</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="username"                data-endpoint="POSTapi-register"
               value="johndoe"
               data-component="body">
    <br>
<p>The desired username. Example: <code>johndoe</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-register"
               value="john@example.com"
               data-component="body">
    <br>
<p>A unique email address. Example: <code>john@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-register"
               value="secret123"
               data-component="body">
    <br>
<p>A secure password. Example: <code>secret123</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-register"
               value="hdtqtqxbajwbpilpmufin"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>hdtqtqxbajwbpilpmufin</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>bio</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="bio"                data-endpoint="POSTapi-register"
               value="llwloauydlsmsjuryvojc"
               data-component="body">
    <br>
<p>Must not be greater than 280 characters. Example: <code>llwloauydlsmsjuryvojc</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password_confirmation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password_confirmation"                data-endpoint="POSTapi-register"
               value="secret123"
               data-component="body">
    <br>
<p>Must match the password. Example: <code>secret123</code></p>
        </div>
        </form>

                <h1 id="block-routes">Block Routes</h1>

    

                                <h2 id="block-routes-POSTapi-users--user_id--block">Block a user</h2>

<p>
</p>



<span id="example-requests-POSTapi-users--user_id--block">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://humzat.local/api/users/01986af5-a34a-70dd-bd82-0458b50c888d/block" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/users/01986af5-a34a-70dd-bd82-0458b50c888d/block"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-users--user_id--block">
</span>
<span id="execution-results-POSTapi-users--user_id--block" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-users--user_id--block"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-users--user_id--block"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-users--user_id--block" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-users--user_id--block">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-users--user_id--block" data-method="POST"
      data-path="api/users/{user_id}/block"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-users--user_id--block', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-users--user_id--block"
                    onclick="tryItOut('POSTapi-users--user_id--block');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-users--user_id--block"
                    onclick="cancelTryOut('POSTapi-users--user_id--block');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-users--user_id--block"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/users/{user_id}/block</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-users--user_id--block"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-users--user_id--block"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="user_id"                data-endpoint="POSTapi-users--user_id--block"
               value="01986af5-a34a-70dd-bd82-0458b50c888d"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>01986af5-a34a-70dd-bd82-0458b50c888d</code></p>
            </div>
                    </form>

                    <h2 id="block-routes-DELETEapi-users--user_id--block">Unblock a user</h2>

<p>
</p>



<span id="example-requests-DELETEapi-users--user_id--block">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://humzat.local/api/users/01986af5-a34a-70dd-bd82-0458b50c888d/block" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/users/01986af5-a34a-70dd-bd82-0458b50c888d/block"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-users--user_id--block">
</span>
<span id="execution-results-DELETEapi-users--user_id--block" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-users--user_id--block"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-users--user_id--block"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-users--user_id--block" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-users--user_id--block">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-users--user_id--block" data-method="DELETE"
      data-path="api/users/{user_id}/block"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-users--user_id--block', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-users--user_id--block"
                    onclick="tryItOut('DELETEapi-users--user_id--block');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-users--user_id--block"
                    onclick="cancelTryOut('DELETEapi-users--user_id--block');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-users--user_id--block"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/users/{user_id}/block</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-users--user_id--block"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-users--user_id--block"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="user_id"                data-endpoint="DELETEapi-users--user_id--block"
               value="01986af5-a34a-70dd-bd82-0458b50c888d"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>01986af5-a34a-70dd-bd82-0458b50c888d</code></p>
            </div>
                    </form>

                    <h2 id="block-routes-GETapi-users-blocked">List users you have blocked</h2>

<p>
</p>



<span id="example-requests-GETapi-users-blocked">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://humzat.local/api/users/blocked" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/users/blocked"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-users-blocked">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-users-blocked" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-users-blocked"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-users-blocked"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-users-blocked" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-users-blocked">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-users-blocked" data-method="GET"
      data-path="api/users/blocked"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-users-blocked', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-users-blocked"
                    onclick="tryItOut('GETapi-users-blocked');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-users-blocked"
                    onclick="cancelTryOut('GETapi-users-blocked');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-users-blocked"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/users/blocked</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-users-blocked"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-users-blocked"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="comment-routes">Comment Routes</h1>

    

                                <h2 id="comment-routes-GETapi-comments">Display a paginated list of top-level comments with their replies.</h2>

<p>
</p>



<span id="example-requests-GETapi-comments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://humzat.local/api/comments" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/comments"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-comments">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 20
x-ratelimit-remaining: 19
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://humzat.local/api/comments?page=1&quot;,
        &quot;last&quot;: &quot;http://humzat.local/api/comments?page=1&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: null
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: null,
        &quot;last_page&quot;: 1,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://humzat.local/api/comments?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://humzat.local/api/comments&quot;,
        &quot;per_page&quot;: 10,
        &quot;to&quot;: null,
        &quot;total&quot;: 0
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-comments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-comments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-comments"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-comments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-comments">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-comments" data-method="GET"
      data-path="api/comments"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-comments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-comments"
                    onclick="tryItOut('GETapi-comments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-comments"
                    onclick="cancelTryOut('GETapi-comments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-comments"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/comments</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="comment-routes-GETapi-comments--id-">Display a specific comment along with its replies.</h2>

<p>
</p>



<span id="example-requests-GETapi-comments--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://humzat.local/api/comments/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/comments/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-comments--id-">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 20
x-ratelimit-remaining: 19
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;No query results for model [App\\Models\\Comment] consequatur&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-comments--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-comments--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-comments--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-comments--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-comments--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-comments--id-" data-method="GET"
      data-path="api/comments/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-comments--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-comments--id-"
                    onclick="tryItOut('GETapi-comments--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-comments--id-"
                    onclick="cancelTryOut('GETapi-comments--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-comments--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/comments/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-comments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-comments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-comments--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the comment. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="comment-routes-POSTapi-comments">Store a newly created comment.</h2>

<p>
</p>



<span id="example-requests-POSTapi-comments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://humzat.local/api/comments" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"body\": \"vmqeopfuudtdsufvyvddq\",
    \"post_id\": \"462ee709-6d9f-345a-95e6-76f833111fb8\",
    \"parent_id\": \"1915c795-5d1c-3def-965b-5abe034dd150\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/comments"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "body": "vmqeopfuudtdsufvyvddq",
    "post_id": "462ee709-6d9f-345a-95e6-76f833111fb8",
    "parent_id": "1915c795-5d1c-3def-965b-5abe034dd150"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-comments">
</span>
<span id="execution-results-POSTapi-comments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-comments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-comments"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-comments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-comments">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-comments" data-method="POST"
      data-path="api/comments"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-comments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-comments"
                    onclick="tryItOut('POSTapi-comments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-comments"
                    onclick="cancelTryOut('POSTapi-comments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-comments"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/comments</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>body</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="body"                data-endpoint="POSTapi-comments"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 5000 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>post_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="post_id"                data-endpoint="POSTapi-comments"
               value="462ee709-6d9f-345a-95e6-76f833111fb8"
               data-component="body">
    <br>
<p>Must be a valid UUID. The <code>id</code> of an existing record in the posts table. Example: <code>462ee709-6d9f-345a-95e6-76f833111fb8</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>parent_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="parent_id"                data-endpoint="POSTapi-comments"
               value="1915c795-5d1c-3def-965b-5abe034dd150"
               data-component="body">
    <br>
<p>Must be a valid UUID. The <code>id</code> of an existing record in the comments table. Example: <code>1915c795-5d1c-3def-965b-5abe034dd150</code></p>
        </div>
        </form>

                    <h2 id="comment-routes-PUTapi-comments--id-">Update a comment if the authenticated user is the owner.</h2>

<p>
</p>



<span id="example-requests-PUTapi-comments--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://humzat.local/api/comments/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"body\": \"vmqeopfuudtdsufvyvddq\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/comments/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "body": "vmqeopfuudtdsufvyvddq"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-comments--id-">
</span>
<span id="execution-results-PUTapi-comments--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-comments--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-comments--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-comments--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-comments--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-comments--id-" data-method="PUT"
      data-path="api/comments/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-comments--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-comments--id-"
                    onclick="tryItOut('PUTapi-comments--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-comments--id-"
                    onclick="cancelTryOut('PUTapi-comments--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-comments--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/comments/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/comments/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-comments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-comments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-comments--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the comment. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>body</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="body"                data-endpoint="PUTapi-comments--id-"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 5000 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
        </form>

                    <h2 id="comment-routes-DELETEapi-comments--id-">Delete a comment.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-comments--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://humzat.local/api/comments/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/comments/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-comments--id-">
</span>
<span id="execution-results-DELETEapi-comments--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-comments--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-comments--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-comments--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-comments--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-comments--id-" data-method="DELETE"
      data-path="api/comments/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-comments--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-comments--id-"
                    onclick="tryItOut('DELETEapi-comments--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-comments--id-"
                    onclick="cancelTryOut('DELETEapi-comments--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-comments--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/comments/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-comments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-comments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-comments--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the comment. Example: <code>consequatur</code></p>
            </div>
                    </form>

                <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-GETapi-me">GET api/me</h2>

<p>
</p>



<span id="example-requests-GETapi-me">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://humzat.local/api/me" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/me"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-me">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-me" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-me"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-me"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-me" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-me">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-me" data-method="GET"
      data-path="api/me"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-me', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-me"
                    onclick="tryItOut('GETapi-me');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-me"
                    onclick="cancelTryOut('GETapi-me');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-me"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/me</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-me"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-me"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="hashtag-routes">Hashtag Routes</h1>

    

                                <h2 id="hashtag-routes-GETapi-hashtags">Display a paginated list of hashtags with the count of related posts.</h2>

<p>
</p>



<span id="example-requests-GETapi-hashtags">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://humzat.local/api/hashtags" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/hashtags"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-hashtags">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 20
x-ratelimit-remaining: 19
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: &quot;b936aa0a-9566-42b5-bdca-c0f5648b1421&quot;,
            &quot;name&quot;: &quot;غزة&quot;,
            &quot;posts_count&quot;: 3,
            &quot;created_at&quot;: &quot;2025-08-02 13:25:37&quot;,
            &quot;updated_at&quot;: &quot;2025-08-02 13:25:37&quot;
        },
        {
            &quot;id&quot;: &quot;738a23cf-5a3e-4dcb-b8ad-aed5106cc288&quot;,
            &quot;name&quot;: &quot;الأمم المتحدة&quot;,
            &quot;posts_count&quot;: 2,
            &quot;created_at&quot;: &quot;2025-08-02 13:25:37&quot;,
            &quot;updated_at&quot;: &quot;2025-08-02 13:25:37&quot;
        },
        {
            &quot;id&quot;: &quot;4c2b2ad0-9d5c-41b4-9755-8f2e6ac8b073&quot;,
            &quot;name&quot;: &quot;المساعدات الإنسانية&quot;,
            &quot;posts_count&quot;: 2,
            &quot;created_at&quot;: &quot;2025-08-02 13:25:37&quot;,
            &quot;updated_at&quot;: &quot;2025-08-02 13:25:37&quot;
        },
        {
            &quot;id&quot;: &quot;9e031b34-985c-42d0-9b19-8265fdee0f1b&quot;,
            &quot;name&quot;: &quot;دونالد ترمب&quot;,
            &quot;posts_count&quot;: 2,
            &quot;created_at&quot;: &quot;2025-08-02 13:25:44&quot;,
            &quot;updated_at&quot;: &quot;2025-08-02 13:25:44&quot;
        },
        {
            &quot;id&quot;: &quot;c5fec62b-f55a-4e82-a502-f6f87bb5eafe&quot;,
            &quot;name&quot;: &quot;غواصات نووية&quot;,
            &quot;posts_count&quot;: 2,
            &quot;created_at&quot;: &quot;2025-08-02 13:25:44&quot;,
            &quot;updated_at&quot;: &quot;2025-08-02 13:25:44&quot;
        },
        {
            &quot;id&quot;: &quot;8840b0c8-cf25-424e-9402-2fbcb8be7620&quot;,
            &quot;name&quot;: &quot;السياسة الأمريكية&quot;,
            &quot;posts_count&quot;: 1,
            &quot;created_at&quot;: &quot;2025-08-02 13:25:40&quot;,
            &quot;updated_at&quot;: &quot;2025-08-02 13:25:40&quot;
        },
        {
            &quot;id&quot;: &quot;aa1b491b-b50b-4dd6-b065-a0a0dcb85846&quot;,
            &quot;name&quot;: &quot;دونالد ترامب&quot;,
            &quot;posts_count&quot;: 1,
            &quot;created_at&quot;: &quot;2025-08-02 13:25:40&quot;,
            &quot;updated_at&quot;: &quot;2025-08-02 13:25:40&quot;
        },
        {
            &quot;id&quot;: &quot;a6bfd5d9-bcc3-4951-aba5-311153948537&quot;,
            &quot;name&quot;: &quot;روسيا&quot;,
            &quot;posts_count&quot;: 1,
            &quot;created_at&quot;: &quot;2025-08-02 13:25:44&quot;,
            &quot;updated_at&quot;: &quot;2025-08-02 13:25:44&quot;
        },
        {
            &quot;id&quot;: &quot;108b9604-fa5c-4101-b853-79e795f0e0a0&quot;,
            &quot;name&quot;: &quot;التوتر الأمريكي الروسي&quot;,
            &quot;posts_count&quot;: 1,
            &quot;created_at&quot;: &quot;2025-08-02 13:25:53&quot;,
            &quot;updated_at&quot;: &quot;2025-08-02 13:25:53&quot;
        },
        {
            &quot;id&quot;: &quot;d3b55a14-da32-4d28-95b2-0e88d165a37f&quot;,
            &quot;name&quot;: &quot;أزمة إنسانية&quot;,
            &quot;posts_count&quot;: 1,
            &quot;created_at&quot;: &quot;2025-08-02 13:25:47&quot;,
            &quot;updated_at&quot;: &quot;2025-08-02 13:25:47&quot;
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://humzat.local/api/hashtags?page=1&quot;,
        &quot;last&quot;: &quot;http://humzat.local/api/hashtags?page=2&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: &quot;http://humzat.local/api/hashtags?page=2&quot;
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 2,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://humzat.local/api/hashtags?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: &quot;http://humzat.local/api/hashtags?page=2&quot;,
                &quot;label&quot;: &quot;2&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://humzat.local/api/hashtags?page=2&quot;,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://humzat.local/api/hashtags&quot;,
        &quot;per_page&quot;: 10,
        &quot;to&quot;: 10,
        &quot;total&quot;: 12
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-hashtags" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-hashtags"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-hashtags"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-hashtags" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-hashtags">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-hashtags" data-method="GET"
      data-path="api/hashtags"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-hashtags', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-hashtags"
                    onclick="tryItOut('GETapi-hashtags');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-hashtags"
                    onclick="cancelTryOut('GETapi-hashtags');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-hashtags"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/hashtags</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-hashtags"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-hashtags"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="hashtag-routes-GETapi-hashtags--id-">Display the specified hashtag along with its related posts (paginated).</h2>

<p>
</p>



<span id="example-requests-GETapi-hashtags--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://humzat.local/api/hashtags/b936aa0a-9566-42b5-bdca-c0f5648b1421" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/hashtags/b936aa0a-9566-42b5-bdca-c0f5648b1421"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-hashtags--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 20
x-ratelimit-remaining: 19
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;hashtag&quot;: {
        &quot;id&quot;: &quot;b936aa0a-9566-42b5-bdca-c0f5648b1421&quot;,
        &quot;name&quot;: &quot;غزة&quot;,
        &quot;created_at&quot;: &quot;2025-08-02 13:25:37&quot;,
        &quot;updated_at&quot;: &quot;2025-08-02 13:25:37&quot;
    },
    &quot;posts&quot;: {
        &quot;data&quot;: [
            {
                &quot;id&quot;: &quot;01986af5-cc6b-73d9-a317-afd5efeb38ec&quot;,
                &quot;user_id&quot;: &quot;01986af5-950c-72fd-91ef-07c57cbb0730&quot;,
                &quot;body&quot;: &quot;الأمم المتحدة توثّق بالفيديو استهداف مدنيين في طوابير المساعدات بغزة\nأظهر مقطع فيديو وثّقه فريق تابع للأمم المتحدة في قطاع غزة، لحظة إطلاق نار مباشر على عشرات المدنيين الفلسطينيين، أثناء تجمعهم قرب أحد مراكز توزيع المساعدات الإنسانية.&quot;,
                &quot;external_url&quot;: &quot;https://www.skynewsarabia.com/middle-east/1811900-%D9%81%D9%8A%D8%AF%D9%8A%D9%88-%D8%AA%D9%88%D8%AB%D9%8A%D9%82-%D8%A7%D9%95%D8%B7%D9%84%D8%A7%D9%82-%D8%A7%D9%84%D9%86%D8%A7%D8%B1-%D9%85%D9%86%D8%AA%D8%B8%D8%B1%D9%8A-%D8%A7%D9%84%D9%85%D8%B3%D8%A7%D8%B9%D8%AF%D8%A7%D8%AA-%D8%BA%D8%B2%D8%A9&quot;,
                &quot;meta&quot;: {
                    &quot;tags&quot;: [
                        &quot;غزة&quot;,
                        &quot;الأمم المتحدة&quot;,
                        &quot;المساعدات الإنسانية&quot;
                    ]
                },
                &quot;hashtags&quot;: [
                    &quot;غزة&quot;,
                    &quot;الأمم المتحدة&quot;,
                    &quot;المساعدات الإنسانية&quot;
                ],
                &quot;media&quot;: [
                    {
                        &quot;id&quot;: &quot;01986af5-d42a-7282-b61d-8983be424496&quot;,
                        &quot;name&quot;: &quot;media/images/3d6f66a6-92c8-4264-9cc7-0ee9132f4821.png&quot;,
                        &quot;url&quot;: &quot;https://d1070l6upf61hp.cloudfront.net/media/images/3d6f66a6-92c8-4264-9cc7-0ee9132f4821.png?Expires=1754144752&amp;Signature=cuY6-ULS6UnJXDElOgJu0eqPO7ve~9R7a8SGDOReSgZIyG6myTxjU6GNVI9e8BaVFoNVvEBFRm9BqqgRLcCMSD~Z~JUk33xZhTdvZnl4u6oA3o7tq75a29ehgBZ2Jy5cUPoOgF2b1skG2U8VaRUfoPO0zgbBTnKFaj1Obfm1p5DV-azLnLxSqFfazInfX6M5TdhM1wBUoGBgRFtlUTRTr~Tk-dNTtnlnPgBwEfuCz0HAQlULiHTgtUz~jpNgybxHMb2L~47kaeBDJnN21s2pfjhex2HXjjA8A~WbWwuV1i5y0peYEguX-O9eEILaHQ8O56WOPCnq6pOLitd6B7IQ3A__&amp;Key-Pair-Id=K1QD0FFQU2OZI5&quot;,
                        &quot;type&quot;: &quot;image&quot;,
                        &quot;meta&quot;: null,
                        &quot;created_at&quot;: &quot;2025-08-02T10:25:52.000000Z&quot;,
                        &quot;updated_at&quot;: &quot;2025-08-02T10:25:52.000000Z&quot;
                    }
                ],
                &quot;type&quot;: &quot;IMAGE&quot;,
                &quot;user&quot;: {
                    &quot;id&quot;: &quot;01986af5-950c-72fd-91ef-07c57cbb0730&quot;,
                    &quot;username&quot;: &quot;skynewsarabia&quot;,
                    &quot;name&quot;: null,
                    &quot;bio&quot;: null,
                    &quot;profile_picture_url&quot;: &quot;https://d1070l6upf61hp.cloudfront.net/profile_pictures/0811d7f3-8833-4d9c-91a9-c5a998b0e6f5.com&amp;client=NEWS_360&amp;size=96&amp;type=FAVICON&amp;fallback_opts=TYPE,SIZE,URL?Expires=1754154948&amp;Signature=hnXSzYO1LIs3XpBtDRniCNFwBf5nmozDtPjQyvifwBW0IYN9eZeb3xlGzVbWhq8j1i~y1QxfmxgJ38iYcPPPXQpS3CO3av-7ooiEGStEncWUd0o0TJNe1bQs4BupaV-lg0h3~2KOJc-3C-UH-9DF819YzqTcdvwjzizDvm6X6mSp~QywPninWZm-aEiqrm~iGJ0afCpLVPS~cU-ZXtXIIc7CUlz-vGlJQ9xagKYQumkZojY0tCsDEGMbxZAMghrKN05eVNdT0hTGg8KsNOlGA~Ao3KKuhPVE4~LayMYsdlFAq5GUsxhsbc-FTQj9uTG4wow-fwo0cBXPGpIAUMSVHg__&amp;Key-Pair-Id=K1QD0FFQU2OZI5&quot;,
                    &quot;created_at&quot;: &quot;2025-08-02T13:25:36+03:00&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-02T13:25:50+03:00&quot;
                },
                &quot;created_at&quot;: &quot;2025-08-02T10:25:50.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-08-02T10:25:50.000000Z&quot;
            },
            {
                &quot;id&quot;: &quot;01986af5-bfc1-7347-a819-c07019e0277b&quot;,
                &quot;user_id&quot;: &quot;01986af5-bc06-713f-9b2a-c6c69c0a752b&quot;,
                &quot;body&quot;: &quot;طبيب بريطاني يكشف: أطفال غزة يسدون جوعهم بالماء والملح\nكشف الجراح البريطاني غرايم غروم، عقب عودته من مهمة إنسانية في قطاع غزة، عن مشاهد مروعة لمعاناة الأطفال من الجوع. وأوضح غروم أن الصغار يلجؤون إلى شرب الماء المالح للشعور بالشبع ومحاولة النوم، في شهادة صادمة تسلط الضوء على تفاقم الأزمة الإنسانية المفتعلة في القطاع.&quot;,
                &quot;external_url&quot;: &quot;https://www.aljazeera.net/news/2025/8/2/%D8%B7%D8%A8%D9%8A%D8%A8-%D8%A8%D8%B1%D9%8A%D8%B7%D8%A7%D9%86%D9%8A-%D8%A7%D9%84%D9%85%D8%A7%D8%A1-%D9%88%D8%A7%D9%84%D9%85%D9%84%D8%AD-%D9%82%D9%88%D8%AA-%D8%A3%D8%B7%D9%81%D8%A7%D9%84&quot;,
                &quot;meta&quot;: {
                    &quot;tags&quot;: [
                        &quot;غزة&quot;,
                        &quot;أزمة إنسانية&quot;,
                        &quot;أطفال غزة&quot;
                    ]
                },
                &quot;hashtags&quot;: [
                    &quot;غزة&quot;,
                    &quot;أزمة إنسانية&quot;,
                    &quot;أطفال غزة&quot;
                ],
                &quot;media&quot;: [
                    {
                        &quot;id&quot;: &quot;01986af5-c74f-7364-9b94-6de95778e7d8&quot;,
                        &quot;name&quot;: &quot;media/images/5bc242e0-a608-4298-96aa-4ac28e29e2e2.jpg&quot;,
                        &quot;url&quot;: &quot;https://d1070l6upf61hp.cloudfront.net/media/images/5bc242e0-a608-4298-96aa-4ac28e29e2e2.jpg?Expires=1754144749&amp;Signature=U5YJ7O0gMjk4l1pvJaAb59DRTL-lgslqj0Mt9jfcWsz8~148GNusGRTh-NXHo2I759pPCATSuv2Ve3jpCsQBy1bF1yPFEnHf1D~y03gJwt~diJedfxU9aDh8GA9evrpm48LTZYRfGClIXqgrfsZSEZrkggntN5mu4QcBZHOPrtKnAbfZAKXMc6I1SdMKAGx1DVz0xbzM3jwBvffG9QvZeT-WL2KSZs2HFlisG7ObCF65iUA5ykSCfbOrBUnPMErLlb0R68ZY3u0oMuM4Y8~WZmZd8KLY2LSYc2mmuu6-XsEIXAnuVbt3TAECUfEsRao~skxaWR07HMsPFhN3~vF6ag__&amp;Key-Pair-Id=K1QD0FFQU2OZI5&quot;,
                        &quot;type&quot;: &quot;image&quot;,
                        &quot;meta&quot;: null,
                        &quot;created_at&quot;: &quot;2025-08-02T10:25:49.000000Z&quot;,
                        &quot;updated_at&quot;: &quot;2025-08-02T10:25:49.000000Z&quot;
                    }
                ],
                &quot;type&quot;: &quot;IMAGE&quot;,
                &quot;user&quot;: {
                    &quot;id&quot;: &quot;01986af5-bc06-713f-9b2a-c6c69c0a752b&quot;,
                    &quot;username&quot;: &quot;aljazeera&quot;,
                    &quot;name&quot;: null,
                    &quot;bio&quot;: null,
                    &quot;profile_picture_url&quot;: &quot;https://d1070l6upf61hp.cloudfront.net/profile_pictures/61c954b7-54c9-43c5-8fd8-e6ee11022002.net&amp;client=NEWS_360&amp;size=96&amp;type=FAVICON&amp;fallback_opts=TYPE,SIZE,URL?Expires=1754154948&amp;Signature=TfcVsFihtz9qaxBupliIfmbPn5oRZBEpK06F9yFhE-nxWOzdgtC45zgT5jHbFFcw85AzIxfv5xcflAF5l-brmaMa7102QBK2ZS4RM7hG-crdR8jaImO7YTempNzY2kOtrYEgVBpaKt-xiHhUVdHcVeUriRPLqdAPgjE4wDWZtkskejLaCw~2vjluKshKcSv-9t9HyUES~SQ56aVVvppcizCSeb5qzUul9qDjm1XySQXNYtdSR1ZZS5GDBM2-RjycqR3LL99rdK8JSVou3U-ZcIPsYGFpwOCwbe8VLLJ2AUi5WVMcELuJyxAGDPlSiuM-UBAYt1jLVg3zlkdPRlUo7w__&amp;Key-Pair-Id=K1QD0FFQU2OZI5&quot;,
                    &quot;created_at&quot;: &quot;2025-08-02T13:25:46+03:00&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-02T13:25:47+03:00&quot;
                },
                &quot;created_at&quot;: &quot;2025-08-02T10:25:47.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-08-02T10:25:47.000000Z&quot;
            },
            {
                &quot;id&quot;: &quot;01986af5-9a1d-705d-a854-50fe75e1578c&quot;,
                &quot;user_id&quot;: &quot;01986af5-950c-72fd-91ef-07c57cbb0730&quot;,
                &quot;body&quot;: &quot;الأمم المتحدة توثّق استهداف منتظري المساعدات في غزة بإطلاق نار حي\nفي واقعة مروعة، وثّق فريق أممي في قطاع غزة لحظة إطلاق نار حي على حشد من المدنيين الفلسطينيين كانوا ينتظرون دورهم لاستلام مساعدات إنسانية بالقرب من أحد مراكز التوزيع.&quot;,
                &quot;external_url&quot;: &quot;https://www.skynewsarabia.com/middle-east/1811900-%D9%81%D9%8A%D8%AF%D9%8A%D9%88-%D8%AA%D9%88%D8%AB%D9%8A%D9%82-%D8%A7%D9%95%D8%B7%D9%84%D8%A7%D9%82-%D8%A7%D9%84%D9%86%D8%A7%D8%B1-%D9%85%D9%86%D8%AA%D8%B8%D8%B1%D9%8A-%D8%A7%D9%84%D9%85%D8%B3%D8%A7%D8%B9%D8%AF%D8%A7%D8%AA-%D8%BA%D8%B2%D8%A9&quot;,
                &quot;meta&quot;: {
                    &quot;tags&quot;: [
                        &quot;غزة&quot;,
                        &quot;الأمم المتحدة&quot;,
                        &quot;المساعدات الإنسانية&quot;
                    ]
                },
                &quot;hashtags&quot;: [
                    &quot;غزة&quot;,
                    &quot;الأمم المتحدة&quot;,
                    &quot;المساعدات الإنسانية&quot;
                ],
                &quot;media&quot;: [
                    {
                        &quot;id&quot;: &quot;01986af5-a270-7075-8ef8-ef75ec51bbf3&quot;,
                        &quot;name&quot;: &quot;media/images/70579c87-700f-44d7-9472-62e85b6ee288.png&quot;,
                        &quot;url&quot;: &quot;https://d1070l6upf61hp.cloudfront.net/media/images/70579c87-700f-44d7-9472-62e85b6ee288.png?Expires=1754144739&amp;Signature=Uad10v6ced3zE2PWbxc13HVsl7hju89nbWkkNR0eH2SCgJkEljcPyZnsPraroUgJ8Wv3saxDH7Dcys9PrEsB~6EKrdAvWdvZMZOdwxuagv4jn77RKIoSslTS2RVOpI1iOwObiG1BtcGlT0DihFxD1G8SikuMaocAs-LjQxpORP-~LBZe2wDM97yLM6-M04eIZmduIzmER9QRPAacpX88IELyGipMZtzkMmMhT2S6emBMSyRlKy5VDVMlPy1nXIsz0gJP7WmNS0yFHI~XOL1zcSC2orjFtQn46SPgMSXTxODJqb-wGaJY67JYXMz-CiA1IQ6W4PAqRhm2Qcs7kfyFGQ__&amp;Key-Pair-Id=K1QD0FFQU2OZI5&quot;,
                        &quot;type&quot;: &quot;image&quot;,
                        &quot;meta&quot;: null,
                        &quot;created_at&quot;: &quot;2025-08-02T10:25:39.000000Z&quot;,
                        &quot;updated_at&quot;: &quot;2025-08-02T10:25:39.000000Z&quot;
                    }
                ],
                &quot;type&quot;: &quot;IMAGE&quot;,
                &quot;user&quot;: {
                    &quot;id&quot;: &quot;01986af5-950c-72fd-91ef-07c57cbb0730&quot;,
                    &quot;username&quot;: &quot;skynewsarabia&quot;,
                    &quot;name&quot;: null,
                    &quot;bio&quot;: null,
                    &quot;profile_picture_url&quot;: &quot;https://d1070l6upf61hp.cloudfront.net/profile_pictures/0811d7f3-8833-4d9c-91a9-c5a998b0e6f5.com&amp;client=NEWS_360&amp;size=96&amp;type=FAVICON&amp;fallback_opts=TYPE,SIZE,URL?Expires=1754154948&amp;Signature=hnXSzYO1LIs3XpBtDRniCNFwBf5nmozDtPjQyvifwBW0IYN9eZeb3xlGzVbWhq8j1i~y1QxfmxgJ38iYcPPPXQpS3CO3av-7ooiEGStEncWUd0o0TJNe1bQs4BupaV-lg0h3~2KOJc-3C-UH-9DF819YzqTcdvwjzizDvm6X6mSp~QywPninWZm-aEiqrm~iGJ0afCpLVPS~cU-ZXtXIIc7CUlz-vGlJQ9xagKYQumkZojY0tCsDEGMbxZAMghrKN05eVNdT0hTGg8KsNOlGA~Ao3KKuhPVE4~LayMYsdlFAq5GUsxhsbc-FTQj9uTG4wow-fwo0cBXPGpIAUMSVHg__&amp;Key-Pair-Id=K1QD0FFQU2OZI5&quot;,
                    &quot;created_at&quot;: &quot;2025-08-02T13:25:36+03:00&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-02T13:25:50+03:00&quot;
                },
                &quot;created_at&quot;: &quot;2025-08-02T10:25:37.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-08-02T10:25:37.000000Z&quot;
            }
        ],
        &quot;links&quot;: {
            &quot;first&quot;: &quot;http://humzat.local/api/hashtags/b936aa0a-9566-42b5-bdca-c0f5648b1421?page=1&quot;,
            &quot;last&quot;: &quot;http://humzat.local/api/hashtags/b936aa0a-9566-42b5-bdca-c0f5648b1421?page=1&quot;,
            &quot;prev&quot;: null,
            &quot;next&quot;: null
        },
        &quot;meta&quot;: {
            &quot;current_page&quot;: 1,
            &quot;from&quot;: 1,
            &quot;last_page&quot;: 1,
            &quot;links&quot;: [
                {
                    &quot;url&quot;: null,
                    &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                    &quot;active&quot;: false
                },
                {
                    &quot;url&quot;: &quot;http://humzat.local/api/hashtags/b936aa0a-9566-42b5-bdca-c0f5648b1421?page=1&quot;,
                    &quot;label&quot;: &quot;1&quot;,
                    &quot;active&quot;: true
                },
                {
                    &quot;url&quot;: null,
                    &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                    &quot;active&quot;: false
                }
            ],
            &quot;path&quot;: &quot;http://humzat.local/api/hashtags/b936aa0a-9566-42b5-bdca-c0f5648b1421&quot;,
            &quot;per_page&quot;: 10,
            &quot;to&quot;: 3,
            &quot;total&quot;: 3
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-hashtags--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-hashtags--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-hashtags--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-hashtags--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-hashtags--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-hashtags--id-" data-method="GET"
      data-path="api/hashtags/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-hashtags--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-hashtags--id-"
                    onclick="tryItOut('GETapi-hashtags--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-hashtags--id-"
                    onclick="cancelTryOut('GETapi-hashtags--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-hashtags--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/hashtags/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-hashtags--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-hashtags--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-hashtags--id-"
               value="b936aa0a-9566-42b5-bdca-c0f5648b1421"
               data-component="url">
    <br>
<p>The ID of the hashtag. Example: <code>b936aa0a-9566-42b5-bdca-c0f5648b1421</code></p>
            </div>
                    </form>

                    <h2 id="hashtag-routes-GETapi-hashtags-by-name--name-">Get the specified hashtag by its name, along with its related posts (paginated).</h2>

<p>
</p>



<span id="example-requests-GETapi-hashtags-by-name--name-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://humzat.local/api/hashtags/by-name/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/hashtags/by-name/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-hashtags-by-name--name-">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 20
x-ratelimit-remaining: 19
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;No query results for model [App\\Models\\Hashtag].&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-hashtags-by-name--name-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-hashtags-by-name--name-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-hashtags-by-name--name-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-hashtags-by-name--name-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-hashtags-by-name--name-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-hashtags-by-name--name-" data-method="GET"
      data-path="api/hashtags/by-name/{name}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-hashtags-by-name--name-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-hashtags-by-name--name-"
                    onclick="tryItOut('GETapi-hashtags-by-name--name-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-hashtags-by-name--name-"
                    onclick="cancelTryOut('GETapi-hashtags-by-name--name-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-hashtags-by-name--name-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/hashtags/by-name/{name}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-hashtags-by-name--name-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-hashtags-by-name--name-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="GETapi-hashtags-by-name--name-"
               value="consequatur"
               data-component="url">
    <br>
<p>Example: <code>consequatur</code></p>
            </div>
                    </form>

                <h1 id="media-routes">Media Routes</h1>

    

                                <h2 id="media-routes-GETapi-media--media_id-">Display the specified media resource.</h2>

<p>
</p>



<span id="example-requests-GETapi-media--media_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://humzat.local/api/media/01986af5-a270-7075-8ef8-ef75ec51bbf3" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/media/01986af5-a270-7075-8ef8-ef75ec51bbf3"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-media--media_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 20
x-ratelimit-remaining: 19
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;media&quot;: {
        &quot;id&quot;: &quot;01986af5-a270-7075-8ef8-ef75ec51bbf3&quot;,
        &quot;name&quot;: &quot;media/images/70579c87-700f-44d7-9472-62e85b6ee288.png&quot;,
        &quot;url&quot;: &quot;https://d1070l6upf61hp.cloudfront.net/media/images/70579c87-700f-44d7-9472-62e85b6ee288.png?Expires=1754144739&amp;Signature=Uad10v6ced3zE2PWbxc13HVsl7hju89nbWkkNR0eH2SCgJkEljcPyZnsPraroUgJ8Wv3saxDH7Dcys9PrEsB~6EKrdAvWdvZMZOdwxuagv4jn77RKIoSslTS2RVOpI1iOwObiG1BtcGlT0DihFxD1G8SikuMaocAs-LjQxpORP-~LBZe2wDM97yLM6-M04eIZmduIzmER9QRPAacpX88IELyGipMZtzkMmMhT2S6emBMSyRlKy5VDVMlPy1nXIsz0gJP7WmNS0yFHI~XOL1zcSC2orjFtQn46SPgMSXTxODJqb-wGaJY67JYXMz-CiA1IQ6W4PAqRhm2Qcs7kfyFGQ__&amp;Key-Pair-Id=K1QD0FFQU2OZI5&quot;,
        &quot;type&quot;: &quot;image&quot;,
        &quot;meta&quot;: null,
        &quot;created_at&quot;: &quot;2025-08-02T10:25:39.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-08-02T10:25:39.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-media--media_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-media--media_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-media--media_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-media--media_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-media--media_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-media--media_id-" data-method="GET"
      data-path="api/media/{media_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-media--media_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-media--media_id-"
                    onclick="tryItOut('GETapi-media--media_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-media--media_id-"
                    onclick="cancelTryOut('GETapi-media--media_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-media--media_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/media/{media_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-media--media_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-media--media_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>media_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="media_id"                data-endpoint="GETapi-media--media_id-"
               value="01986af5-a270-7075-8ef8-ef75ec51bbf3"
               data-component="url">
    <br>
<p>The ID of the media. Example: <code>01986af5-a270-7075-8ef8-ef75ec51bbf3</code></p>
            </div>
                    </form>

                    <h2 id="media-routes-POSTapi-media">Store a newly uploaded image and create media record.</h2>

<p>
</p>



<span id="example-requests-POSTapi-media">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://humzat.local/api/media" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "post_id=66529e01-d113-3473-8d6f-9e11e09332ea"\
    --form "image=@/tmp/phpXduf6V" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/media"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('post_id', '66529e01-d113-3473-8d6f-9e11e09332ea');
body.append('image', document.querySelector('input[name="image"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-media">
</span>
<span id="execution-results-POSTapi-media" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-media"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-media"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-media" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-media">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-media" data-method="POST"
      data-path="api/media"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-media', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-media"
                    onclick="tryItOut('POSTapi-media');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-media"
                    onclick="cancelTryOut('POSTapi-media');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-media"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/media</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-media"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-media"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>image</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="image"                data-endpoint="POSTapi-media"
               value=""
               data-component="body">
    <br>
<p>Must be an image. Must not be greater than 5120 kilobytes. Example: <code>/tmp/phpXduf6V</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>post_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="post_id"                data-endpoint="POSTapi-media"
               value="66529e01-d113-3473-8d6f-9e11e09332ea"
               data-component="body">
    <br>
<p>Must be a valid UUID. The <code>id</code> of an existing record in the posts table. Example: <code>66529e01-d113-3473-8d6f-9e11e09332ea</code></p>
        </div>
        </form>

                    <h2 id="media-routes-DELETEapi-media--media_id-">Delete the specified media resource.</h2>

<p>
</p>

<p>Checks authorization to ensure the user can delete the media,
then deletes the media file from storage and removes the database record.</p>

<span id="example-requests-DELETEapi-media--media_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://humzat.local/api/media/01986af5-a270-7075-8ef8-ef75ec51bbf3" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/media/01986af5-a270-7075-8ef8-ef75ec51bbf3"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-media--media_id-">
</span>
<span id="execution-results-DELETEapi-media--media_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-media--media_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-media--media_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-media--media_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-media--media_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-media--media_id-" data-method="DELETE"
      data-path="api/media/{media_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-media--media_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-media--media_id-"
                    onclick="tryItOut('DELETEapi-media--media_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-media--media_id-"
                    onclick="cancelTryOut('DELETEapi-media--media_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-media--media_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/media/{media_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-media--media_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-media--media_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>media_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="media_id"                data-endpoint="DELETEapi-media--media_id-"
               value="01986af5-a270-7075-8ef8-ef75ec51bbf3"
               data-component="url">
    <br>
<p>The ID of the media. Example: <code>01986af5-a270-7075-8ef8-ef75ec51bbf3</code></p>
            </div>
                    </form>

                <h1 id="post-routes">Post Routes</h1>

    

                                <h2 id="post-routes-GETapi-posts">Display a paginated list of posts with related data.</h2>

<p>
</p>



<span id="example-requests-GETapi-posts">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://humzat.local/api/posts" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/posts"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-posts">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 20
x-ratelimit-remaining: 19
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: &quot;01986af5-d8f8-71c4-9df0-aac7483b6d84&quot;,
            &quot;user_id&quot;: &quot;01986af5-afcf-7280-aeba-60a6b2dd6102&quot;,
            &quot;body&quot;: &quot;تصعيد في المواجهة مع روسيا: ترمب يأمر بنشر غواصات نووية\nفي خطوة تصعيدية ترفع منسوب التوتر مع موسكو، أعلن الرئيس الأمريكي دونالد ترمب عن نيته إصدار أوامر بنشر غواصتين نوويتين في مناطق استراتيجية، ردًا على ما اعتبرها استفزازات روسية.&quot;,
            &quot;external_url&quot;: &quot;https://aawsat.com/%D8%A7%D9%84%D8%B9%D8%A7%D9%84%D9%85/%D8%A7%D9%84%D9%88%D9%84%D8%A7%D9%8A%D8%A7%D8%AA-%D8%A7%D9%84%D9%85%D8%AA%D8%AD%D8%AF%D8%A9%E2%80%8B/5171018-%D8%B6%D8%BA%D9%88%D8%B7-%D8%B9%D9%84%D9%89-%D8%A8%D9%88%D8%AA%D9%8A%D9%86-%D9%88%D8%AA%D8%AD%D8%B1%D9%8A%D9%83-%D9%84%D9%80%D8%BA%D9%88%D8%A7%D8%B5%D8%A7%D8%AA-%D9%86%D9%88%D9%88%D9%8A%D8%A9-%D9%85%D8%A7%D8%B0%D8%A7-%D9%88%D8%B1%D8%A7%D8%A1-%D8%AA%D8%AD%D8%B0%D9%8A%D8%B1-%D8%AA%D8%B1%D9%85%D8%A8-%D8%A7%D9%84%D9%85%D8%B2%D8%AF%D9%88%D8%AC%D8%9F&quot;,
            &quot;meta&quot;: {
                &quot;tags&quot;: [
                    &quot;دونالد ترمب&quot;,
                    &quot;غواصات نووية&quot;,
                    &quot;التوتر الأمريكي الروسي&quot;
                ]
            },
            &quot;hashtags&quot;: [
                &quot;دونالد ترمب&quot;,
                &quot;غواصات نووية&quot;,
                &quot;التوتر الأمريكي الروسي&quot;
            ],
            &quot;media&quot;: [
                {
                    &quot;id&quot;: &quot;01986af5-df86-71cd-8ae7-97d823b84a95&quot;,
                    &quot;name&quot;: &quot;media/images/24749a90-041a-45ce-bd1a-e806d90fb9c3.webp&quot;,
                    &quot;url&quot;: &quot;https://d1070l6upf61hp.cloudfront.net/media/images/24749a90-041a-45ce-bd1a-e806d90fb9c3.webp?Expires=1754144755&amp;Signature=DyLXF1H1G1h00yS08zzQ9JimeZWPRF5F2kD2w2X9~vXwgnpizC4SUpvTSvAHoRZiQb2Upuf0s4dn53LIgMiIwgsJpHS7CwaTprxO6G4oIRqJ9tRH2eq97oqiJEezgpLvoCA1p-70vPUitIpN35CL14YjNE1nqpoebEZFIhA8h9ZUqcZjHecZk~AtD9YZGGC7KU22yZOgbn8RF4srV4PB9AdIZdaUi7ABq0kYijv116Jsk1COtAuaofUsMK4KCEd15f7kOjF7xdDILFTTprlmM4BREXfZ-QUCZBxLsSPAO1LKh5tf3iTarp2JnV1ZKlN0d1fKicXpNLZ66BmEehGD1g__&amp;Key-Pair-Id=K1QD0FFQU2OZI5&quot;,
                    &quot;type&quot;: &quot;image&quot;,
                    &quot;meta&quot;: null,
                    &quot;created_at&quot;: &quot;2025-08-02T10:25:55.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-02T10:25:55.000000Z&quot;
                }
            ],
            &quot;comments&quot;: [],
            &quot;type&quot;: &quot;IMAGE&quot;,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;01986af5-afcf-7280-aeba-60a6b2dd6102&quot;,
                &quot;username&quot;: &quot;aawsat&quot;,
                &quot;name&quot;: null,
                &quot;bio&quot;: null,
                &quot;profile_picture_url&quot;: &quot;https://d1070l6upf61hp.cloudfront.net/profile_pictures/cc247977-2bc2-4b16-a465-cc5941458f1f.com&amp;client=NEWS_360&amp;size=96&amp;type=FAVICON&amp;fallback_opts=TYPE,SIZE,URL?Expires=1754154948&amp;Signature=Eme0DVSXqmcfUtL8VG7SOOvKGdukzmaL8WLhIIR99pWp8bKoevwBGM9S~Z~IXyUc1xicASVdbRfV6S3kz1lMz~~TIuYY8LHn0feysdd~6bx5mCHsGubb1dtp3RfcjB7DO2bu~qEJ2oChIm-jzvhJ0ZFkTmbIa3ah7eJbyOLcEPBUZu0~9PhLC86TR~3QW8~O4RhkFmNxE~sIu8-M2TRyjZr6i1AsH2iIZCRLT~9Aqqps7vTO7ZrVrYEmG8wopQHSpaE1AlSi0ue-YLyWKU4fAvZHrRoqdGxCV9SRXgdOyCnVDoGWWe5kBuEJW-pi8Yq7ETE0p4ADrJHO3N5nTF4d7A__&amp;Key-Pair-Id=K1QD0FFQU2OZI5&quot;,
                &quot;created_at&quot;: &quot;2025-08-02T13:25:42+03:00&quot;,
                &quot;updated_at&quot;: &quot;2025-08-02T13:25:53+03:00&quot;
            },
            &quot;created_at&quot;: &quot;2025-08-02T10:25:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-08-02T10:25:53.000000Z&quot;
        },
        {
            &quot;id&quot;: &quot;01986af5-cc6b-73d9-a317-afd5efeb38ec&quot;,
            &quot;user_id&quot;: &quot;01986af5-950c-72fd-91ef-07c57cbb0730&quot;,
            &quot;body&quot;: &quot;الأمم المتحدة توثّق بالفيديو استهداف مدنيين في طوابير المساعدات بغزة\nأظهر مقطع فيديو وثّقه فريق تابع للأمم المتحدة في قطاع غزة، لحظة إطلاق نار مباشر على عشرات المدنيين الفلسطينيين، أثناء تجمعهم قرب أحد مراكز توزيع المساعدات الإنسانية.&quot;,
            &quot;external_url&quot;: &quot;https://www.skynewsarabia.com/middle-east/1811900-%D9%81%D9%8A%D8%AF%D9%8A%D9%88-%D8%AA%D9%88%D8%AB%D9%8A%D9%82-%D8%A7%D9%95%D8%B7%D9%84%D8%A7%D9%82-%D8%A7%D9%84%D9%86%D8%A7%D8%B1-%D9%85%D9%86%D8%AA%D8%B8%D8%B1%D9%8A-%D8%A7%D9%84%D9%85%D8%B3%D8%A7%D8%B9%D8%AF%D8%A7%D8%AA-%D8%BA%D8%B2%D8%A9&quot;,
            &quot;meta&quot;: {
                &quot;tags&quot;: [
                    &quot;غزة&quot;,
                    &quot;الأمم المتحدة&quot;,
                    &quot;المساعدات الإنسانية&quot;
                ]
            },
            &quot;hashtags&quot;: [
                &quot;غزة&quot;,
                &quot;الأمم المتحدة&quot;,
                &quot;المساعدات الإنسانية&quot;
            ],
            &quot;media&quot;: [
                {
                    &quot;id&quot;: &quot;01986af5-d42a-7282-b61d-8983be424496&quot;,
                    &quot;name&quot;: &quot;media/images/3d6f66a6-92c8-4264-9cc7-0ee9132f4821.png&quot;,
                    &quot;url&quot;: &quot;https://d1070l6upf61hp.cloudfront.net/media/images/3d6f66a6-92c8-4264-9cc7-0ee9132f4821.png?Expires=1754144752&amp;Signature=cuY6-ULS6UnJXDElOgJu0eqPO7ve~9R7a8SGDOReSgZIyG6myTxjU6GNVI9e8BaVFoNVvEBFRm9BqqgRLcCMSD~Z~JUk33xZhTdvZnl4u6oA3o7tq75a29ehgBZ2Jy5cUPoOgF2b1skG2U8VaRUfoPO0zgbBTnKFaj1Obfm1p5DV-azLnLxSqFfazInfX6M5TdhM1wBUoGBgRFtlUTRTr~Tk-dNTtnlnPgBwEfuCz0HAQlULiHTgtUz~jpNgybxHMb2L~47kaeBDJnN21s2pfjhex2HXjjA8A~WbWwuV1i5y0peYEguX-O9eEILaHQ8O56WOPCnq6pOLitd6B7IQ3A__&amp;Key-Pair-Id=K1QD0FFQU2OZI5&quot;,
                    &quot;type&quot;: &quot;image&quot;,
                    &quot;meta&quot;: null,
                    &quot;created_at&quot;: &quot;2025-08-02T10:25:52.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-02T10:25:52.000000Z&quot;
                }
            ],
            &quot;comments&quot;: [],
            &quot;type&quot;: &quot;IMAGE&quot;,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;01986af5-950c-72fd-91ef-07c57cbb0730&quot;,
                &quot;username&quot;: &quot;skynewsarabia&quot;,
                &quot;name&quot;: null,
                &quot;bio&quot;: null,
                &quot;profile_picture_url&quot;: &quot;https://d1070l6upf61hp.cloudfront.net/profile_pictures/0811d7f3-8833-4d9c-91a9-c5a998b0e6f5.com&amp;client=NEWS_360&amp;size=96&amp;type=FAVICON&amp;fallback_opts=TYPE,SIZE,URL?Expires=1754154948&amp;Signature=hnXSzYO1LIs3XpBtDRniCNFwBf5nmozDtPjQyvifwBW0IYN9eZeb3xlGzVbWhq8j1i~y1QxfmxgJ38iYcPPPXQpS3CO3av-7ooiEGStEncWUd0o0TJNe1bQs4BupaV-lg0h3~2KOJc-3C-UH-9DF819YzqTcdvwjzizDvm6X6mSp~QywPninWZm-aEiqrm~iGJ0afCpLVPS~cU-ZXtXIIc7CUlz-vGlJQ9xagKYQumkZojY0tCsDEGMbxZAMghrKN05eVNdT0hTGg8KsNOlGA~Ao3KKuhPVE4~LayMYsdlFAq5GUsxhsbc-FTQj9uTG4wow-fwo0cBXPGpIAUMSVHg__&amp;Key-Pair-Id=K1QD0FFQU2OZI5&quot;,
                &quot;created_at&quot;: &quot;2025-08-02T13:25:36+03:00&quot;,
                &quot;updated_at&quot;: &quot;2025-08-02T13:25:50+03:00&quot;
            },
            &quot;created_at&quot;: &quot;2025-08-02T10:25:50.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-08-02T10:25:50.000000Z&quot;
        },
        {
            &quot;id&quot;: &quot;01986af5-bfc1-7347-a819-c07019e0277b&quot;,
            &quot;user_id&quot;: &quot;01986af5-bc06-713f-9b2a-c6c69c0a752b&quot;,
            &quot;body&quot;: &quot;طبيب بريطاني يكشف: أطفال غزة يسدون جوعهم بالماء والملح\nكشف الجراح البريطاني غرايم غروم، عقب عودته من مهمة إنسانية في قطاع غزة، عن مشاهد مروعة لمعاناة الأطفال من الجوع. وأوضح غروم أن الصغار يلجؤون إلى شرب الماء المالح للشعور بالشبع ومحاولة النوم، في شهادة صادمة تسلط الضوء على تفاقم الأزمة الإنسانية المفتعلة في القطاع.&quot;,
            &quot;external_url&quot;: &quot;https://www.aljazeera.net/news/2025/8/2/%D8%B7%D8%A8%D9%8A%D8%A8-%D8%A8%D8%B1%D9%8A%D8%B7%D8%A7%D9%86%D9%8A-%D8%A7%D9%84%D9%85%D8%A7%D8%A1-%D9%88%D8%A7%D9%84%D9%85%D9%84%D8%AD-%D9%82%D9%88%D8%AA-%D8%A3%D8%B7%D9%81%D8%A7%D9%84&quot;,
            &quot;meta&quot;: {
                &quot;tags&quot;: [
                    &quot;غزة&quot;,
                    &quot;أزمة إنسانية&quot;,
                    &quot;أطفال غزة&quot;
                ]
            },
            &quot;hashtags&quot;: [
                &quot;غزة&quot;,
                &quot;أزمة إنسانية&quot;,
                &quot;أطفال غزة&quot;
            ],
            &quot;media&quot;: [
                {
                    &quot;id&quot;: &quot;01986af5-c74f-7364-9b94-6de95778e7d8&quot;,
                    &quot;name&quot;: &quot;media/images/5bc242e0-a608-4298-96aa-4ac28e29e2e2.jpg&quot;,
                    &quot;url&quot;: &quot;https://d1070l6upf61hp.cloudfront.net/media/images/5bc242e0-a608-4298-96aa-4ac28e29e2e2.jpg?Expires=1754144749&amp;Signature=U5YJ7O0gMjk4l1pvJaAb59DRTL-lgslqj0Mt9jfcWsz8~148GNusGRTh-NXHo2I759pPCATSuv2Ve3jpCsQBy1bF1yPFEnHf1D~y03gJwt~diJedfxU9aDh8GA9evrpm48LTZYRfGClIXqgrfsZSEZrkggntN5mu4QcBZHOPrtKnAbfZAKXMc6I1SdMKAGx1DVz0xbzM3jwBvffG9QvZeT-WL2KSZs2HFlisG7ObCF65iUA5ykSCfbOrBUnPMErLlb0R68ZY3u0oMuM4Y8~WZmZd8KLY2LSYc2mmuu6-XsEIXAnuVbt3TAECUfEsRao~skxaWR07HMsPFhN3~vF6ag__&amp;Key-Pair-Id=K1QD0FFQU2OZI5&quot;,
                    &quot;type&quot;: &quot;image&quot;,
                    &quot;meta&quot;: null,
                    &quot;created_at&quot;: &quot;2025-08-02T10:25:49.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-02T10:25:49.000000Z&quot;
                }
            ],
            &quot;comments&quot;: [],
            &quot;type&quot;: &quot;IMAGE&quot;,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;01986af5-bc06-713f-9b2a-c6c69c0a752b&quot;,
                &quot;username&quot;: &quot;aljazeera&quot;,
                &quot;name&quot;: null,
                &quot;bio&quot;: null,
                &quot;profile_picture_url&quot;: &quot;https://d1070l6upf61hp.cloudfront.net/profile_pictures/61c954b7-54c9-43c5-8fd8-e6ee11022002.net&amp;client=NEWS_360&amp;size=96&amp;type=FAVICON&amp;fallback_opts=TYPE,SIZE,URL?Expires=1754154948&amp;Signature=TfcVsFihtz9qaxBupliIfmbPn5oRZBEpK06F9yFhE-nxWOzdgtC45zgT5jHbFFcw85AzIxfv5xcflAF5l-brmaMa7102QBK2ZS4RM7hG-crdR8jaImO7YTempNzY2kOtrYEgVBpaKt-xiHhUVdHcVeUriRPLqdAPgjE4wDWZtkskejLaCw~2vjluKshKcSv-9t9HyUES~SQ56aVVvppcizCSeb5qzUul9qDjm1XySQXNYtdSR1ZZS5GDBM2-RjycqR3LL99rdK8JSVou3U-ZcIPsYGFpwOCwbe8VLLJ2AUi5WVMcELuJyxAGDPlSiuM-UBAYt1jLVg3zlkdPRlUo7w__&amp;Key-Pair-Id=K1QD0FFQU2OZI5&quot;,
                &quot;created_at&quot;: &quot;2025-08-02T13:25:46+03:00&quot;,
                &quot;updated_at&quot;: &quot;2025-08-02T13:25:47+03:00&quot;
            },
            &quot;created_at&quot;: &quot;2025-08-02T10:25:47.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-08-02T10:25:47.000000Z&quot;
        },
        {
            &quot;id&quot;: &quot;01986af5-b437-714e-9cf9-71beeb65400b&quot;,
            &quot;user_id&quot;: &quot;01986af5-afcf-7280-aeba-60a6b2dd6102&quot;,
            &quot;body&quot;: &quot;تصعيدًا للتوتر مع روسيا.. ترمب يأمر بنشر غواصات نووية\nفي خطوة تصعيدية، أعلن الرئيس الأمريكي دونالد ترمب عن قراره بإرسال غواصتين نوويتين إلى مناطق استراتيجية، وذلك في سياق الرد على ما اعتبرها استفزازات من موسكو، مما يرفع من حدة المواجهة بين القوتين.&quot;,
            &quot;external_url&quot;: &quot;https://aawsat.com/%D8%A7%D9%84%D8%B9%D8%A7%D9%84%D9%85/%D8%A7%D9%84%D9%88%D9%84%D8%A7%D9%8A%D8%A7%D8%AA-%D8%A7%D9%84%D9%85%D8%AA%D8%AD%D8%AF%D8%A9%E2%80%8B/5171018-%D8%B6%D8%BA%D9%88%D8%B7-%D8%B9%D9%84%D9%89-%D8%A8%D9%88%D8%AA%D9%8A%D9%86-%D9%88%D8%AA%D8%AD%D8%B1%D9%8A%D9%83-%D9%84%D9%80%D8%BA%D9%88%D8%A7%D8%B5%D8%A7%D8%AA-%D9%86%D9%88%D9%88%D9%8A%D8%A9-%D9%85%D8%A7%D8%B0%D8%A7-%D9%88%D8%B1%D8%A7%D8%A1-%D8%AA%D8%AD%D8%B0%D9%8A%D8%B1-%D8%AA%D8%B1%D9%85%D8%A8-%D8%A7%D9%84%D9%85%D8%B2%D8%AF%D9%88%D8%AC%D8%9F&quot;,
            &quot;meta&quot;: {
                &quot;tags&quot;: [
                    &quot;دونالد ترمب&quot;,
                    &quot;روسيا&quot;,
                    &quot;غواصات نووية&quot;
                ]
            },
            &quot;hashtags&quot;: [
                &quot;دونالد ترمب&quot;,
                &quot;روسيا&quot;,
                &quot;غواصات نووية&quot;
            ],
            &quot;media&quot;: [
                {
                    &quot;id&quot;: &quot;01986af5-bb27-70a4-87ff-0f0d50f7610d&quot;,
                    &quot;name&quot;: &quot;media/images/11868192-67c3-42cf-a2a5-3ef9eb0c9a92.webp&quot;,
                    &quot;url&quot;: &quot;https://d1070l6upf61hp.cloudfront.net/media/images/11868192-67c3-42cf-a2a5-3ef9eb0c9a92.webp?Expires=1754144745&amp;Signature=YTM9ofWMBRL6FmEshntDJc4RIka2H4B8cEsfQLbE6vdSJ0X3MNxhGVi-OZgAUD1BcTdu6H6fbV~C9dSMKS2XijftxV0s0La-znIZmj1oxhgUAFiyyMaLtVyfM9Uy3I0JRm9eIlQlmlS7-aVfRRlMavtjT6-Y8jVdvCZWGgZpCPzzfBESQyJtP-EzPkEEIgxbSVfVittt7phZ7w9pVWhpjaP~xE-kMyxtCaz-ErqzuVvCAB03wkPSdU7NjAo2pLUcxBOaHSwQ-2-Ax9cT4kJaHj-77vs5h8SvYL8SuSQqQTptwvY1~pkBz1Fj8l2XceV8MwE6K4A0cKaSZr68oSaitg__&amp;Key-Pair-Id=K1QD0FFQU2OZI5&quot;,
                    &quot;type&quot;: &quot;image&quot;,
                    &quot;meta&quot;: null,
                    &quot;created_at&quot;: &quot;2025-08-02T10:25:45.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-02T10:25:45.000000Z&quot;
                }
            ],
            &quot;comments&quot;: [],
            &quot;type&quot;: &quot;IMAGE&quot;,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;01986af5-afcf-7280-aeba-60a6b2dd6102&quot;,
                &quot;username&quot;: &quot;aawsat&quot;,
                &quot;name&quot;: null,
                &quot;bio&quot;: null,
                &quot;profile_picture_url&quot;: &quot;https://d1070l6upf61hp.cloudfront.net/profile_pictures/cc247977-2bc2-4b16-a465-cc5941458f1f.com&amp;client=NEWS_360&amp;size=96&amp;type=FAVICON&amp;fallback_opts=TYPE,SIZE,URL?Expires=1754154948&amp;Signature=Eme0DVSXqmcfUtL8VG7SOOvKGdukzmaL8WLhIIR99pWp8bKoevwBGM9S~Z~IXyUc1xicASVdbRfV6S3kz1lMz~~TIuYY8LHn0feysdd~6bx5mCHsGubb1dtp3RfcjB7DO2bu~qEJ2oChIm-jzvhJ0ZFkTmbIa3ah7eJbyOLcEPBUZu0~9PhLC86TR~3QW8~O4RhkFmNxE~sIu8-M2TRyjZr6i1AsH2iIZCRLT~9Aqqps7vTO7ZrVrYEmG8wopQHSpaE1AlSi0ue-YLyWKU4fAvZHrRoqdGxCV9SRXgdOyCnVDoGWWe5kBuEJW-pi8Yq7ETE0p4ADrJHO3N5nTF4d7A__&amp;Key-Pair-Id=K1QD0FFQU2OZI5&quot;,
                &quot;created_at&quot;: &quot;2025-08-02T13:25:42+03:00&quot;,
                &quot;updated_at&quot;: &quot;2025-08-02T13:25:53+03:00&quot;
            },
            &quot;created_at&quot;: &quot;2025-08-02T10:25:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-08-02T10:25:44.000000Z&quot;
        },
        {
            &quot;id&quot;: &quot;01986af5-a7f4-7027-8c69-63e1d53b8adf&quot;,
            &quot;user_id&quot;: &quot;01986af5-a34a-70dd-bd82-0458b50c888d&quot;,
            &quot;body&quot;: &quot;ترامب يكشف تفاصيل زيارة مبعوثه لمركز مساعدات أمريكي في غزة\nأعلن الرئيس الأمريكي دونالد ترامب، يوم الجمعة، عن تفاصيل زيارة قام بها مبعوثه للشرق الأوسط، ستيف ويتكوف، إلى قطاع غزة. وأوضح ترامب أن ويتكوف تفقد موقعًا لتوزيع المساعدات تشرف عليه مؤسسة \&quot;غزة الإنسانية\&quot;، وهي منظمة مثيرة للجدل تتلقى دعمًا من الولايات المتحدة.&quot;,
            &quot;external_url&quot;: &quot;https://arabic.cnn.com/middle-east/article/2025/08/02/trump-says-he-spoke-with-witkoff-after-his-trip-to-gaza&quot;,
            &quot;meta&quot;: {
                &quot;tags&quot;: [
                    &quot;دونالد ترامب&quot;,
                    &quot;قطاع غزة&quot;,
                    &quot;السياسة الأمريكية&quot;
                ]
            },
            &quot;hashtags&quot;: [
                &quot;دونالد ترامب&quot;,
                &quot;قطاع غزة&quot;,
                &quot;السياسة الأمريكية&quot;
            ],
            &quot;media&quot;: [
                {
                    &quot;id&quot;: &quot;01986af5-ae72-715c-9ffc-531774730ae5&quot;,
                    &quot;name&quot;: &quot;media/images/b7715a11-14b3-4033-ae69-4b000e2617cd.jpg&quot;,
                    &quot;url&quot;: &quot;https://d1070l6upf61hp.cloudfront.net/media/images/b7715a11-14b3-4033-ae69-4b000e2617cd.jpg?Expires=1754144742&amp;Signature=cz-pghpaGQFC8AJ5Rn20reEbSlboJ1vMuGgbdPl4VGAMYrjjrFSyCiBk8Kd8MwnmBvaO60QM4XSm7YQHIPYkOt2gzjOTXc6SB68rDRp66GlSNxynHHeHOUOQV64jXhAcrayFkieKcYvd~laM7bwiw~j0CnLGLM-0yLvC4K-GuvfkyjThKw9bv6UeHDp~Es5lfdZAZaZ2ASqXAQ22x-UAVc~fwamRM5eCI4Oji6hYmP4f9K6YTMfJD4wGIgW9mBjCfJNtB2JiMeywwq~7FfrW2HTcc5fhevg0n6DYaIcOMJb72dAGBvCaipZwjfJjPR74VVNaq8iKckAKckeInQrA5A__&amp;Key-Pair-Id=K1QD0FFQU2OZI5&quot;,
                    &quot;type&quot;: &quot;image&quot;,
                    &quot;meta&quot;: null,
                    &quot;created_at&quot;: &quot;2025-08-02T10:25:42.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-02T10:25:42.000000Z&quot;
                }
            ],
            &quot;comments&quot;: [],
            &quot;type&quot;: &quot;IMAGE&quot;,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;01986af5-a34a-70dd-bd82-0458b50c888d&quot;,
                &quot;username&quot;: &quot;cnn&quot;,
                &quot;name&quot;: null,
                &quot;bio&quot;: null,
                &quot;profile_picture_url&quot;: &quot;https://d1070l6upf61hp.cloudfront.net/profile_pictures/25c6e293-bf89-4b96-ad0e-300b059acfad.com&amp;client=NEWS_360&amp;size=96&amp;type=FAVICON&amp;fallback_opts=TYPE,SIZE,URL?Expires=1754154948&amp;Signature=PL7wJ-hWx7NhP~aQsiDDgh7QYhOLIu4L3XulrHmiXvX6-VOq2vM5F1b-qdBQRAxDw5mV~y286DBH-pZ0kzBT7YbRKbvgLMOg2gaAFRyewn1qNt2qr6ZXlWlwZHHKcXXyLRB~IxASGpbhK~vb7bH9EjAR3ywWwitZut-mQFcY-B3SWxtuOzZZqwhVL0cj7QafIvxWJsqvXDqS2J6iKb7AfBZjDmJeBL9MugdLAlLKHK7N8d80tUJmCwfbzIooyGN9snDBk1UI9ScoIaXzpdzWazIRR~0hIDwF5W4sbQ3JbcGwWJz5MBnFOURhFxlnTrXgH75lPLLFRqLmNppEgBeq3Q__&amp;Key-Pair-Id=K1QD0FFQU2OZI5&quot;,
                &quot;created_at&quot;: &quot;2025-08-02T13:25:39+03:00&quot;,
                &quot;updated_at&quot;: &quot;2025-08-02T13:25:40+03:00&quot;
            },
            &quot;created_at&quot;: &quot;2025-08-02T10:25:40.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-08-02T10:25:40.000000Z&quot;
        },
        {
            &quot;id&quot;: &quot;01986af5-9a1d-705d-a854-50fe75e1578c&quot;,
            &quot;user_id&quot;: &quot;01986af5-950c-72fd-91ef-07c57cbb0730&quot;,
            &quot;body&quot;: &quot;الأمم المتحدة توثّق استهداف منتظري المساعدات في غزة بإطلاق نار حي\nفي واقعة مروعة، وثّق فريق أممي في قطاع غزة لحظة إطلاق نار حي على حشد من المدنيين الفلسطينيين كانوا ينتظرون دورهم لاستلام مساعدات إنسانية بالقرب من أحد مراكز التوزيع.&quot;,
            &quot;external_url&quot;: &quot;https://www.skynewsarabia.com/middle-east/1811900-%D9%81%D9%8A%D8%AF%D9%8A%D9%88-%D8%AA%D9%88%D8%AB%D9%8A%D9%82-%D8%A7%D9%95%D8%B7%D9%84%D8%A7%D9%82-%D8%A7%D9%84%D9%86%D8%A7%D8%B1-%D9%85%D9%86%D8%AA%D8%B8%D8%B1%D9%8A-%D8%A7%D9%84%D9%85%D8%B3%D8%A7%D8%B9%D8%AF%D8%A7%D8%AA-%D8%BA%D8%B2%D8%A9&quot;,
            &quot;meta&quot;: {
                &quot;tags&quot;: [
                    &quot;غزة&quot;,
                    &quot;الأمم المتحدة&quot;,
                    &quot;المساعدات الإنسانية&quot;
                ]
            },
            &quot;hashtags&quot;: [
                &quot;غزة&quot;,
                &quot;الأمم المتحدة&quot;,
                &quot;المساعدات الإنسانية&quot;
            ],
            &quot;media&quot;: [
                {
                    &quot;id&quot;: &quot;01986af5-a270-7075-8ef8-ef75ec51bbf3&quot;,
                    &quot;name&quot;: &quot;media/images/70579c87-700f-44d7-9472-62e85b6ee288.png&quot;,
                    &quot;url&quot;: &quot;https://d1070l6upf61hp.cloudfront.net/media/images/70579c87-700f-44d7-9472-62e85b6ee288.png?Expires=1754144739&amp;Signature=Uad10v6ced3zE2PWbxc13HVsl7hju89nbWkkNR0eH2SCgJkEljcPyZnsPraroUgJ8Wv3saxDH7Dcys9PrEsB~6EKrdAvWdvZMZOdwxuagv4jn77RKIoSslTS2RVOpI1iOwObiG1BtcGlT0DihFxD1G8SikuMaocAs-LjQxpORP-~LBZe2wDM97yLM6-M04eIZmduIzmER9QRPAacpX88IELyGipMZtzkMmMhT2S6emBMSyRlKy5VDVMlPy1nXIsz0gJP7WmNS0yFHI~XOL1zcSC2orjFtQn46SPgMSXTxODJqb-wGaJY67JYXMz-CiA1IQ6W4PAqRhm2Qcs7kfyFGQ__&amp;Key-Pair-Id=K1QD0FFQU2OZI5&quot;,
                    &quot;type&quot;: &quot;image&quot;,
                    &quot;meta&quot;: null,
                    &quot;created_at&quot;: &quot;2025-08-02T10:25:39.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-02T10:25:39.000000Z&quot;
                }
            ],
            &quot;comments&quot;: [],
            &quot;type&quot;: &quot;IMAGE&quot;,
            &quot;user&quot;: {
                &quot;id&quot;: &quot;01986af5-950c-72fd-91ef-07c57cbb0730&quot;,
                &quot;username&quot;: &quot;skynewsarabia&quot;,
                &quot;name&quot;: null,
                &quot;bio&quot;: null,
                &quot;profile_picture_url&quot;: &quot;https://d1070l6upf61hp.cloudfront.net/profile_pictures/0811d7f3-8833-4d9c-91a9-c5a998b0e6f5.com&amp;client=NEWS_360&amp;size=96&amp;type=FAVICON&amp;fallback_opts=TYPE,SIZE,URL?Expires=1754154948&amp;Signature=hnXSzYO1LIs3XpBtDRniCNFwBf5nmozDtPjQyvifwBW0IYN9eZeb3xlGzVbWhq8j1i~y1QxfmxgJ38iYcPPPXQpS3CO3av-7ooiEGStEncWUd0o0TJNe1bQs4BupaV-lg0h3~2KOJc-3C-UH-9DF819YzqTcdvwjzizDvm6X6mSp~QywPninWZm-aEiqrm~iGJ0afCpLVPS~cU-ZXtXIIc7CUlz-vGlJQ9xagKYQumkZojY0tCsDEGMbxZAMghrKN05eVNdT0hTGg8KsNOlGA~Ao3KKuhPVE4~LayMYsdlFAq5GUsxhsbc-FTQj9uTG4wow-fwo0cBXPGpIAUMSVHg__&amp;Key-Pair-Id=K1QD0FFQU2OZI5&quot;,
                &quot;created_at&quot;: &quot;2025-08-02T13:25:36+03:00&quot;,
                &quot;updated_at&quot;: &quot;2025-08-02T13:25:50+03:00&quot;
            },
            &quot;created_at&quot;: &quot;2025-08-02T10:25:37.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-08-02T10:25:37.000000Z&quot;
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://humzat.local/api/posts?page=1&quot;,
        &quot;last&quot;: &quot;http://humzat.local/api/posts?page=1&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: null
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 1,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://humzat.local/api/posts?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://humzat.local/api/posts&quot;,
        &quot;per_page&quot;: 10,
        &quot;to&quot;: 6,
        &quot;total&quot;: 6
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-posts" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-posts"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-posts"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-posts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-posts">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-posts" data-method="GET"
      data-path="api/posts"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-posts', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-posts"
                    onclick="tryItOut('GETapi-posts');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-posts"
                    onclick="cancelTryOut('GETapi-posts');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-posts"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/posts</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-posts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-posts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="post-routes-GETapi-posts--id-">Display a single post by ID.</h2>

<p>
</p>



<span id="example-requests-GETapi-posts--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://humzat.local/api/posts/01986af5-9a1d-705d-a854-50fe75e1578c" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/posts/01986af5-9a1d-705d-a854-50fe75e1578c"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-posts--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 20
x-ratelimit-remaining: 19
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: &quot;01986af5-9a1d-705d-a854-50fe75e1578c&quot;,
        &quot;user_id&quot;: &quot;01986af5-950c-72fd-91ef-07c57cbb0730&quot;,
        &quot;body&quot;: &quot;الأمم المتحدة توثّق استهداف منتظري المساعدات في غزة بإطلاق نار حي\nفي واقعة مروعة، وثّق فريق أممي في قطاع غزة لحظة إطلاق نار حي على حشد من المدنيين الفلسطينيين كانوا ينتظرون دورهم لاستلام مساعدات إنسانية بالقرب من أحد مراكز التوزيع.&quot;,
        &quot;external_url&quot;: &quot;https://www.skynewsarabia.com/middle-east/1811900-%D9%81%D9%8A%D8%AF%D9%8A%D9%88-%D8%AA%D9%88%D8%AB%D9%8A%D9%82-%D8%A7%D9%95%D8%B7%D9%84%D8%A7%D9%82-%D8%A7%D9%84%D9%86%D8%A7%D8%B1-%D9%85%D9%86%D8%AA%D8%B8%D8%B1%D9%8A-%D8%A7%D9%84%D9%85%D8%B3%D8%A7%D8%B9%D8%AF%D8%A7%D8%AA-%D8%BA%D8%B2%D8%A9&quot;,
        &quot;meta&quot;: {
            &quot;tags&quot;: [
                &quot;غزة&quot;,
                &quot;الأمم المتحدة&quot;,
                &quot;المساعدات الإنسانية&quot;
            ]
        },
        &quot;hashtags&quot;: [
            &quot;غزة&quot;,
            &quot;الأمم المتحدة&quot;,
            &quot;المساعدات الإنسانية&quot;
        ],
        &quot;media&quot;: [
            {
                &quot;id&quot;: &quot;01986af5-a270-7075-8ef8-ef75ec51bbf3&quot;,
                &quot;name&quot;: &quot;media/images/70579c87-700f-44d7-9472-62e85b6ee288.png&quot;,
                &quot;url&quot;: &quot;https://d1070l6upf61hp.cloudfront.net/media/images/70579c87-700f-44d7-9472-62e85b6ee288.png?Expires=1754144739&amp;Signature=Uad10v6ced3zE2PWbxc13HVsl7hju89nbWkkNR0eH2SCgJkEljcPyZnsPraroUgJ8Wv3saxDH7Dcys9PrEsB~6EKrdAvWdvZMZOdwxuagv4jn77RKIoSslTS2RVOpI1iOwObiG1BtcGlT0DihFxD1G8SikuMaocAs-LjQxpORP-~LBZe2wDM97yLM6-M04eIZmduIzmER9QRPAacpX88IELyGipMZtzkMmMhT2S6emBMSyRlKy5VDVMlPy1nXIsz0gJP7WmNS0yFHI~XOL1zcSC2orjFtQn46SPgMSXTxODJqb-wGaJY67JYXMz-CiA1IQ6W4PAqRhm2Qcs7kfyFGQ__&amp;Key-Pair-Id=K1QD0FFQU2OZI5&quot;,
                &quot;type&quot;: &quot;image&quot;,
                &quot;meta&quot;: null,
                &quot;created_at&quot;: &quot;2025-08-02T10:25:39.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-08-02T10:25:39.000000Z&quot;
            }
        ],
        &quot;comments&quot;: [],
        &quot;type&quot;: &quot;IMAGE&quot;,
        &quot;user&quot;: {
            &quot;id&quot;: &quot;01986af5-950c-72fd-91ef-07c57cbb0730&quot;,
            &quot;username&quot;: &quot;skynewsarabia&quot;,
            &quot;name&quot;: null,
            &quot;bio&quot;: null,
            &quot;profile_picture_url&quot;: &quot;https://d1070l6upf61hp.cloudfront.net/profile_pictures/0811d7f3-8833-4d9c-91a9-c5a998b0e6f5.com&amp;client=NEWS_360&amp;size=96&amp;type=FAVICON&amp;fallback_opts=TYPE,SIZE,URL?Expires=1754154948&amp;Signature=hnXSzYO1LIs3XpBtDRniCNFwBf5nmozDtPjQyvifwBW0IYN9eZeb3xlGzVbWhq8j1i~y1QxfmxgJ38iYcPPPXQpS3CO3av-7ooiEGStEncWUd0o0TJNe1bQs4BupaV-lg0h3~2KOJc-3C-UH-9DF819YzqTcdvwjzizDvm6X6mSp~QywPninWZm-aEiqrm~iGJ0afCpLVPS~cU-ZXtXIIc7CUlz-vGlJQ9xagKYQumkZojY0tCsDEGMbxZAMghrKN05eVNdT0hTGg8KsNOlGA~Ao3KKuhPVE4~LayMYsdlFAq5GUsxhsbc-FTQj9uTG4wow-fwo0cBXPGpIAUMSVHg__&amp;Key-Pair-Id=K1QD0FFQU2OZI5&quot;,
            &quot;created_at&quot;: &quot;2025-08-02T13:25:36+03:00&quot;,
            &quot;updated_at&quot;: &quot;2025-08-02T13:25:50+03:00&quot;
        },
        &quot;created_at&quot;: &quot;2025-08-02T10:25:37.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-08-02T10:25:37.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-posts--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-posts--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-posts--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-posts--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-posts--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-posts--id-" data-method="GET"
      data-path="api/posts/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-posts--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-posts--id-"
                    onclick="tryItOut('GETapi-posts--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-posts--id-"
                    onclick="cancelTryOut('GETapi-posts--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-posts--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/posts/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-posts--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-posts--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-posts--id-"
               value="01986af5-9a1d-705d-a854-50fe75e1578c"
               data-component="url">
    <br>
<p>The ID of the post. Example: <code>01986af5-9a1d-705d-a854-50fe75e1578c</code></p>
            </div>
                    </form>

                    <h2 id="post-routes-POSTapi-posts--post_id--share">Increment the post share count.</h2>

<p>
</p>



<span id="example-requests-POSTapi-posts--post_id--share">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://humzat.local/api/posts/01986af5-9a1d-705d-a854-50fe75e1578c/share" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/posts/01986af5-9a1d-705d-a854-50fe75e1578c/share"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-posts--post_id--share">
</span>
<span id="execution-results-POSTapi-posts--post_id--share" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-posts--post_id--share"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-posts--post_id--share"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-posts--post_id--share" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-posts--post_id--share">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-posts--post_id--share" data-method="POST"
      data-path="api/posts/{post_id}/share"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-posts--post_id--share', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-posts--post_id--share"
                    onclick="tryItOut('POSTapi-posts--post_id--share');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-posts--post_id--share"
                    onclick="cancelTryOut('POSTapi-posts--post_id--share');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-posts--post_id--share"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/posts/{post_id}/share</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-posts--post_id--share"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-posts--post_id--share"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>post_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="post_id"                data-endpoint="POSTapi-posts--post_id--share"
               value="01986af5-9a1d-705d-a854-50fe75e1578c"
               data-component="url">
    <br>
<p>The ID of the post. Example: <code>01986af5-9a1d-705d-a854-50fe75e1578c</code></p>
            </div>
                    </form>

                    <h2 id="post-routes-POSTapi-posts">Store a newly created post.</h2>

<p>
</p>



<span id="example-requests-POSTapi-posts">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://humzat.local/api/posts" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"body\": \"consequatur\",
    \"external_url\": \"https:\\/\\/www.mueller.com\\/laborum-eius-est-dolor-dolores-minus-voluptatem\",
    \"type\": \"AUDIO\",
    \"meta\": {
        \"tags\": [
            \"sufvyvddqamniihfqcoyn\"
        ]
    }
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/posts"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "body": "consequatur",
    "external_url": "https:\/\/www.mueller.com\/laborum-eius-est-dolor-dolores-minus-voluptatem",
    "type": "AUDIO",
    "meta": {
        "tags": [
            "sufvyvddqamniihfqcoyn"
        ]
    }
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-posts">
</span>
<span id="execution-results-POSTapi-posts" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-posts"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-posts"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-posts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-posts">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-posts" data-method="POST"
      data-path="api/posts"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-posts', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-posts"
                    onclick="tryItOut('POSTapi-posts');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-posts"
                    onclick="cancelTryOut('POSTapi-posts');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-posts"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/posts</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-posts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-posts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>body</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="body"                data-endpoint="POSTapi-posts"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>external_url</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="external_url"                data-endpoint="POSTapi-posts"
               value="https://www.mueller.com/laborum-eius-est-dolor-dolores-minus-voluptatem"
               data-component="body">
    <br>
<p>Must be a valid URL. Must not be greater than 2048 characters. Example: <code>https://www.mueller.com/laborum-eius-est-dolor-dolores-minus-voluptatem</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="POSTapi-posts"
               value="AUDIO"
               data-component="body">
    <br>
<p>Example: <code>AUDIO</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>TEXT</code></li> <li><code>VIDEO</code></li> <li><code>IMAGE</code></li> <li><code>LINK</code></li> <li><code>AUDIO</code></li> <li><code>POLL</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>meta</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
<br>

            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>tags</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="meta.tags[0]"                data-endpoint="POSTapi-posts"
               data-component="body">
        <input type="text" style="display: none"
               name="meta.tags[1]"                data-endpoint="POSTapi-posts"
               data-component="body">
    <br>
<p>Must not be greater than 30 characters.</p>
                    </div>
                                    </details>
        </div>
        </form>

                    <h2 id="post-routes-PUTapi-posts--id-">Update the specified post.</h2>

<p>
</p>



<span id="example-requests-PUTapi-posts--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://humzat.local/api/posts/01986af5-9a1d-705d-a854-50fe75e1578c" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"body\": \"consequatur\",
    \"external_url\": \"https:\\/\\/www.mueller.com\\/laborum-eius-est-dolor-dolores-minus-voluptatem\",
    \"meta\": {
        \"tags\": [
            \"sufvyvddqamniihfqcoyn\"
        ]
    }
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/posts/01986af5-9a1d-705d-a854-50fe75e1578c"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "body": "consequatur",
    "external_url": "https:\/\/www.mueller.com\/laborum-eius-est-dolor-dolores-minus-voluptatem",
    "meta": {
        "tags": [
            "sufvyvddqamniihfqcoyn"
        ]
    }
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-posts--id-">
</span>
<span id="execution-results-PUTapi-posts--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-posts--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-posts--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-posts--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-posts--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-posts--id-" data-method="PUT"
      data-path="api/posts/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-posts--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-posts--id-"
                    onclick="tryItOut('PUTapi-posts--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-posts--id-"
                    onclick="cancelTryOut('PUTapi-posts--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-posts--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/posts/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/posts/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-posts--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-posts--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-posts--id-"
               value="01986af5-9a1d-705d-a854-50fe75e1578c"
               data-component="url">
    <br>
<p>The ID of the post. Example: <code>01986af5-9a1d-705d-a854-50fe75e1578c</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>body</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="body"                data-endpoint="PUTapi-posts--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>external_url</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="external_url"                data-endpoint="PUTapi-posts--id-"
               value="https://www.mueller.com/laborum-eius-est-dolor-dolores-minus-voluptatem"
               data-component="body">
    <br>
<p>Must be a valid URL. Example: <code>https://www.mueller.com/laborum-eius-est-dolor-dolores-minus-voluptatem</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>meta</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
<br>

            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>tags</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="meta.tags[0]"                data-endpoint="PUTapi-posts--id-"
               data-component="body">
        <input type="text" style="display: none"
               name="meta.tags[1]"                data-endpoint="PUTapi-posts--id-"
               data-component="body">
    <br>
<p>Must not be greater than 30 characters.</p>
                    </div>
                                    </details>
        </div>
        </form>

                    <h2 id="post-routes-DELETEapi-posts--id-">Delete the specified post.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-posts--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://humzat.local/api/posts/01986af5-9a1d-705d-a854-50fe75e1578c" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/posts/01986af5-9a1d-705d-a854-50fe75e1578c"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-posts--id-">
</span>
<span id="execution-results-DELETEapi-posts--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-posts--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-posts--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-posts--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-posts--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-posts--id-" data-method="DELETE"
      data-path="api/posts/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-posts--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-posts--id-"
                    onclick="tryItOut('DELETEapi-posts--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-posts--id-"
                    onclick="cancelTryOut('DELETEapi-posts--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-posts--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/posts/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-posts--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-posts--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-posts--id-"
               value="01986af5-9a1d-705d-a854-50fe75e1578c"
               data-component="url">
    <br>
<p>The ID of the post. Example: <code>01986af5-9a1d-705d-a854-50fe75e1578c</code></p>
            </div>
                    </form>

                <h1 id="user-routes">User Routes</h1>

    

                                <h2 id="user-routes-GETapi-users--user_id-">Show public profile of the specified user.</h2>

<p>
</p>

<p>Denies access if blocked.</p>

<span id="example-requests-GETapi-users--user_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://humzat.local/api/users/01986af5-a34a-70dd-bd82-0458b50c888d" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/users/01986af5-a34a-70dd-bd82-0458b50c888d"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-users--user_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 20
x-ratelimit-remaining: 19
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: &quot;01986af5-a34a-70dd-bd82-0458b50c888d&quot;,
        &quot;username&quot;: &quot;cnn&quot;,
        &quot;name&quot;: null,
        &quot;bio&quot;: null,
        &quot;profile_picture_url&quot;: &quot;https://d1070l6upf61hp.cloudfront.net/profile_pictures/25c6e293-bf89-4b96-ad0e-300b059acfad.com&amp;client=NEWS_360&amp;size=96&amp;type=FAVICON&amp;fallback_opts=TYPE,SIZE,URL?Expires=1754154948&amp;Signature=PL7wJ-hWx7NhP~aQsiDDgh7QYhOLIu4L3XulrHmiXvX6-VOq2vM5F1b-qdBQRAxDw5mV~y286DBH-pZ0kzBT7YbRKbvgLMOg2gaAFRyewn1qNt2qr6ZXlWlwZHHKcXXyLRB~IxASGpbhK~vb7bH9EjAR3ywWwitZut-mQFcY-B3SWxtuOzZZqwhVL0cj7QafIvxWJsqvXDqS2J6iKb7AfBZjDmJeBL9MugdLAlLKHK7N8d80tUJmCwfbzIooyGN9snDBk1UI9ScoIaXzpdzWazIRR~0hIDwF5W4sbQ3JbcGwWJz5MBnFOURhFxlnTrXgH75lPLLFRqLmNppEgBeq3Q__&amp;Key-Pair-Id=K1QD0FFQU2OZI5&quot;,
        &quot;created_at&quot;: &quot;2025-08-02T13:25:39+03:00&quot;,
        &quot;updated_at&quot;: &quot;2025-08-02T13:25:40+03:00&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-users--user_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-users--user_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-users--user_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-users--user_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-users--user_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-users--user_id-" data-method="GET"
      data-path="api/users/{user_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-users--user_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-users--user_id-"
                    onclick="tryItOut('GETapi-users--user_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-users--user_id-"
                    onclick="cancelTryOut('GETapi-users--user_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-users--user_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/users/{user_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-users--user_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-users--user_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="user_id"                data-endpoint="GETapi-users--user_id-"
               value="01986af5-a34a-70dd-bd82-0458b50c888d"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>01986af5-a34a-70dd-bd82-0458b50c888d</code></p>
            </div>
                    </form>

                    <h2 id="user-routes-GETapi-users--user_id--posts">Get paginated posts created by the specified user.</h2>

<p>
</p>

<p>Denies access if blocked.</p>

<span id="example-requests-GETapi-users--user_id--posts">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://humzat.local/api/users/01986af5-a34a-70dd-bd82-0458b50c888d/posts" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/users/01986af5-a34a-70dd-bd82-0458b50c888d/posts"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-users--user_id--posts">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 20
x-ratelimit-remaining: 19
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: &quot;01986af5-a7f4-7027-8c69-63e1d53b8adf&quot;,
            &quot;user_id&quot;: &quot;01986af5-a34a-70dd-bd82-0458b50c888d&quot;,
            &quot;body&quot;: &quot;ترامب يكشف تفاصيل زيارة مبعوثه لمركز مساعدات أمريكي في غزة\nأعلن الرئيس الأمريكي دونالد ترامب، يوم الجمعة، عن تفاصيل زيارة قام بها مبعوثه للشرق الأوسط، ستيف ويتكوف، إلى قطاع غزة. وأوضح ترامب أن ويتكوف تفقد موقعًا لتوزيع المساعدات تشرف عليه مؤسسة \&quot;غزة الإنسانية\&quot;، وهي منظمة مثيرة للجدل تتلقى دعمًا من الولايات المتحدة.&quot;,
            &quot;external_url&quot;: &quot;https://arabic.cnn.com/middle-east/article/2025/08/02/trump-says-he-spoke-with-witkoff-after-his-trip-to-gaza&quot;,
            &quot;meta&quot;: {
                &quot;tags&quot;: [
                    &quot;دونالد ترامب&quot;,
                    &quot;قطاع غزة&quot;,
                    &quot;السياسة الأمريكية&quot;
                ]
            },
            &quot;media&quot;: [
                {
                    &quot;id&quot;: &quot;01986af5-ae72-715c-9ffc-531774730ae5&quot;,
                    &quot;name&quot;: &quot;media/images/b7715a11-14b3-4033-ae69-4b000e2617cd.jpg&quot;,
                    &quot;url&quot;: &quot;https://d1070l6upf61hp.cloudfront.net/media/images/b7715a11-14b3-4033-ae69-4b000e2617cd.jpg?Expires=1754144742&amp;Signature=cz-pghpaGQFC8AJ5Rn20reEbSlboJ1vMuGgbdPl4VGAMYrjjrFSyCiBk8Kd8MwnmBvaO60QM4XSm7YQHIPYkOt2gzjOTXc6SB68rDRp66GlSNxynHHeHOUOQV64jXhAcrayFkieKcYvd~laM7bwiw~j0CnLGLM-0yLvC4K-GuvfkyjThKw9bv6UeHDp~Es5lfdZAZaZ2ASqXAQ22x-UAVc~fwamRM5eCI4Oji6hYmP4f9K6YTMfJD4wGIgW9mBjCfJNtB2JiMeywwq~7FfrW2HTcc5fhevg0n6DYaIcOMJb72dAGBvCaipZwjfJjPR74VVNaq8iKckAKckeInQrA5A__&amp;Key-Pair-Id=K1QD0FFQU2OZI5&quot;,
                    &quot;type&quot;: &quot;image&quot;,
                    &quot;meta&quot;: null,
                    &quot;created_at&quot;: &quot;2025-08-02T10:25:42.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-08-02T10:25:42.000000Z&quot;
                }
            ],
            &quot;comments&quot;: [],
            &quot;type&quot;: &quot;IMAGE&quot;,
            &quot;created_at&quot;: &quot;2025-08-02T10:25:40.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-08-02T10:25:40.000000Z&quot;
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://humzat.local/api/users/01986af5-a34a-70dd-bd82-0458b50c888d/posts?page=1&quot;,
        &quot;last&quot;: &quot;http://humzat.local/api/users/01986af5-a34a-70dd-bd82-0458b50c888d/posts?page=1&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: null
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 1,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://humzat.local/api/users/01986af5-a34a-70dd-bd82-0458b50c888d/posts?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://humzat.local/api/users/01986af5-a34a-70dd-bd82-0458b50c888d/posts&quot;,
        &quot;per_page&quot;: 10,
        &quot;to&quot;: 1,
        &quot;total&quot;: 1
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-users--user_id--posts" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-users--user_id--posts"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-users--user_id--posts"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-users--user_id--posts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-users--user_id--posts">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-users--user_id--posts" data-method="GET"
      data-path="api/users/{user_id}/posts"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-users--user_id--posts', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-users--user_id--posts"
                    onclick="tryItOut('GETapi-users--user_id--posts');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-users--user_id--posts"
                    onclick="cancelTryOut('GETapi-users--user_id--posts');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-users--user_id--posts"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/users/{user_id}/posts</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-users--user_id--posts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-users--user_id--posts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="user_id"                data-endpoint="GETapi-users--user_id--posts"
               value="01986af5-a34a-70dd-bd82-0458b50c888d"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>01986af5-a34a-70dd-bd82-0458b50c888d</code></p>
            </div>
                    </form>

                    <h2 id="user-routes-GETapi-users--user_id--comments">Get paginated comments made by the specified user.</h2>

<p>
</p>

<p>Denies access if blocked.</p>

<span id="example-requests-GETapi-users--user_id--comments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://humzat.local/api/users/01986af5-a34a-70dd-bd82-0458b50c888d/comments" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/users/01986af5-a34a-70dd-bd82-0458b50c888d/comments"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-users--user_id--comments">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 20
x-ratelimit-remaining: 19
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://humzat.local/api/users/01986af5-a34a-70dd-bd82-0458b50c888d/comments?page=1&quot;,
        &quot;last&quot;: &quot;http://humzat.local/api/users/01986af5-a34a-70dd-bd82-0458b50c888d/comments?page=1&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: null
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: null,
        &quot;last_page&quot;: 1,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://humzat.local/api/users/01986af5-a34a-70dd-bd82-0458b50c888d/comments?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://humzat.local/api/users/01986af5-a34a-70dd-bd82-0458b50c888d/comments&quot;,
        &quot;per_page&quot;: 10,
        &quot;to&quot;: null,
        &quot;total&quot;: 0
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-users--user_id--comments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-users--user_id--comments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-users--user_id--comments"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-users--user_id--comments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-users--user_id--comments">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-users--user_id--comments" data-method="GET"
      data-path="api/users/{user_id}/comments"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-users--user_id--comments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-users--user_id--comments"
                    onclick="tryItOut('GETapi-users--user_id--comments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-users--user_id--comments"
                    onclick="cancelTryOut('GETapi-users--user_id--comments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-users--user_id--comments"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/users/{user_id}/comments</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-users--user_id--comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-users--user_id--comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="user_id"                data-endpoint="GETapi-users--user_id--comments"
               value="01986af5-a34a-70dd-bd82-0458b50c888d"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>01986af5-a34a-70dd-bd82-0458b50c888d</code></p>
            </div>
                    </form>

                    <h2 id="user-routes-POSTapi-users-profile-picture">Upload or update the authenticated user&#039;s profile picture.</h2>

<p>
</p>



<span id="example-requests-POSTapi-users-profile-picture">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://humzat.local/api/users/profile-picture" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "image=@/tmp/php6tJomI" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://humzat.local/api/users/profile-picture"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('image', document.querySelector('input[name="image"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-users-profile-picture">
</span>
<span id="execution-results-POSTapi-users-profile-picture" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-users-profile-picture"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-users-profile-picture"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-users-profile-picture" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-users-profile-picture">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-users-profile-picture" data-method="POST"
      data-path="api/users/profile-picture"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-users-profile-picture', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-users-profile-picture"
                    onclick="tryItOut('POSTapi-users-profile-picture');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-users-profile-picture"
                    onclick="cancelTryOut('POSTapi-users-profile-picture');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-users-profile-picture"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/users/profile-picture</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-users-profile-picture"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-users-profile-picture"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>image</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="image"                data-endpoint="POSTapi-users-profile-picture"
               value=""
               data-component="body">
    <br>
<p>Must be an image. Must not be greater than 3072 kilobytes. Example: <code>/tmp/php6tJomI</code></p>
        </div>
        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>

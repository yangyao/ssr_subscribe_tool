# how to use

## deploy to netlify 

[![Deploy to Netlify](https://www.netlify.com/img/deploy/button.svg)](https://app.netlify.com/start/deploy?repository=https://github.com/yangyao/ssr_subscribe_tool)


### netlify setting

- get your access_token at [Personal access tokens](https://app.netlify.com/account/applications)
- set env variable `ACCESS_TOKEN` and `DOMAIN` at `build-environment-variables`(note:domain is your netlify site link)
- set your webhook at `build-hooks`, then copy the link.(note: when a submit is trigger, a rebuild will happen)
- set you form notify choose `outgoing-notifications` then paste your webhook url

### add subscribe source 

> although netlify was only for static sites ,but with forms and webhook it can be dynamic.
> there is a litter trick:when a form is submit,netify will visit a outgoing url,we set then outgoing url with is's buid hook! wow!

- visit `{your netlify link }/sub
- submit the subscribe form
- wait a few minute (rebuild..) 


## deploy on your own server
    
    `composer install && php -S 127.0.0.1`

## add node

    visit `{your domain link }/add?node={your ssr link}`
    
## add subscribe

    visit `{your domain link }/sub?link={your sub link}`


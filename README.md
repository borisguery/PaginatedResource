PaginatedResource
=================

Description
-----------

A resource wrapper to encapsulate paginated resource into REST-like API.

It is designed to provide paging data along with a resource collection. (See [examples](#example))

It is mostly supposed to be used with JMSSerializerBundle but there are no dependencies against it
and it should work with/without any other Serializer component.

This library is mostly a draft but has been heavily tested and it should be production ready in most case.

Installation
------------

Using [Composer](http://getcomposer.org/), just require the borisguery/paginated-resource package:

``` javascript
{
  "require": {
    "borisguery/paginated-resource": "dev-master"
  }
}
```

If you wish to use this library with Pagerfanta or Doctrine 2 ArrayCollection, install the according dependencies:
``` javascript
{
  "require": {
    "pagerfanta/pagerfanta": "*",
    "doctrine/common": ">2.0",
  }
}
```

It may not be needed if you already use Doctrine2 ORM and/or any of the Pagerfanta Bundle.

Usage
-----

### Basic usage

```php

namespace Acme;

use Bgy\PaginatedResource\Resource\ArrayResource;

class ArticlesController {

    public function getArticles()
    {
        $articles = array(
            array(
                'title' => 'Lorem ipsum',
                'body'  => 'Not worth reading',
            ),
            array(
                'title' => 'Dolor sid amet',
                'body'  => 'Awesome blog post',
            ),
        );

        $resource = new ArrayResource($articles, 'articles');

        echo json_encode(
            array(
                $key     => $resource->getData(),
                'paging' => $resource->getPaging(),
            )
        );
    }
}
```

The result will looks like:

``` javascript
{
    "articles": [
       {
           "title": "Lorem ipsum",
           "body" : "Not worth reading"
       },
       {
           "title": "Dolor sid amet",
           "body" : "Awesome blog post"
       }
    ],
    "paging": {
        "total_item_count":    2,
        "total_page_count":    1,
        "item_count_per_page": 2,
        "current_page":        1,
        "current_item_count":  2
    }
}
```

Obviously, this isn't really usefull since we have to know both the initial resource type and we need to serialize
the data ourselve.

Thanks to the `ResourceFactory` you can dynamically create resource according to their initial type.

### Using the `ResourceFactory`

```php

namespace Acme;

use Bgy\PaginatedResource\Resource\ArrayResource;

class ArticlesController {

    public function getArticles()
    {
        $articles = array(
            array(
                'title' => 'Lorem ipsum',
                'body'  => 'Not worth reading',
            ),
            array(
                'title' => 'Dolor sid amet',
                'body'  => 'Awesome blog post',
            ),
        );

        $resource = new ResourceFactory($articles, 'articles');

        echo $this->dependencyInjectionContainer->get('serializer')
            ->serialize($resource, 'json');
    }
}
```

Will result the same as above.

### Using ResourceFactory and JMSSerializerBundle

Taking the previous example, you may need to manually configure how the serialized result will look like.
Let's try with the JMSSerializerBundle.

If we assume the 'serializer' service from the above example is an instance of `JMS\SerializerBundle\Serializer\Serializer`
the result will looks like this:

```javascript
{
    {
        "total_item_count":    2,
        "total_page_count":    1,
        "item_count_per_page": 2,
        "current_page":        1,
        "current_item_count":  2
    },
    "data_key": "articles",
    "articles": [
       {
           "title": "Lorem ipsum",
           "body" : "Not worth reading"
       },
       {
           "title": "Dolor sid amet",
           "body" : "Awesome blog post"
       }
    ],
    "paging": {
        "total_item_count":    2,
        "total_page_count":    1,
        "item_count_per_page": 2,
        "current_page":        1,
        "current_item_count":  2
    }
}
```

Not really sexy.

#### JMSSerializerBundle config to the rescue

In the `contrib/` folder, you will find a basic configuration which will make the Serializer acts as we want to.
In order to configure it you need to specify to the Serializer where are the associated configuration for the base
class.

This may be found in `contrib/jms-serializer/PaginatedResource/Resource/AbstractResource.yml`

Just add:

```yaml
      BgyPaginatedResource:
        namespace_prefix: 'Bgy\PaginatedResource\Resource'
        path: "%kernel.root_dir%/../vendor/borisguery/paginated-resource/contrib/Bgy/PaginatedResource/Resource"
```

To your `config.yml`.

This will results in:

``` javascript
{
    "articles": [
       {
           "title": "Lorem ipsum",
           "body" : "Not worth reading"
       },
       {
           "title": "Dolor sid amet",
           "body" : "Awesome blog post"
       }
    ],
    "paging": {
        "total_item_count":    2,
        "total_page_count":    1,
        "item_count_per_page": 2,
        "current_page":        1,
        "current_item_count":  2
    }
}
```

### Custom Resources
#### Availables Resources

There are currently 4 allowed Resources.

* `NullResource`, usefull when your collection is empty and returns `NULL`
* `ArrayResource`, which takes a native PHP array
* `ArrayCollectionResource`, intended to work with `Doctrine\Common\Collection\ArrayCollection`
* `PagerfantaResource`, works with the Pagerfanta paginator

#### Adding custom Resource

If you want to make it work with your own type, you can add Custom Resource, just implement the `ResourceInterface`.

It may be tricky to implement it yourself, and you likely want to extend the `AbstractResource` because the properties
need to exist to make the serializer works correctly.

Take a look at the existing Resource to know what to do with it, it is really simple, I promise.

Run the test
------------

First make sure you have installed all the dependencies, run:

`$ composer install --dev`

then, run the test from within the root directory:

`$ phpunit`

Contributing
------------

If you have some time to spare on an useless project and would like to help take a look at the [list of issues](http://github.com/borisguery/PaginatedResource/issues).

Requirements
------------

* PHP 5.3+
* Internet connection

Authors
-------

Boris Guéry - <guery.b@gmail.com> - <http://twitter.com/borisguery> - <http://borisguery.com>

License
-------

`Bgy\PaginatedResource` is licensed under the WTFPL License - see the LICENSE file for details

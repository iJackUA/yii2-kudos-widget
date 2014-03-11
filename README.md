yii2-kudos-widget
=================

Yii2 widget for Svbtle style Kudos. Based on JS from https://github.com/masukomi/kudos

## Demo
On [posts details page of my blog](http://stdout.in) or original JS widget [demo](http://masukomi.github.com/kudos/)

## Usage example

```php
	Kudos::widget(
		[
			'widgetId' => 'post',  // unique id of widget on page, to allow more than one widget on the page
			'uid' => $post->id,  // uid of Kudoable element, for stat count
			'count' => $post->kudos, // initial Kudos value, to display
			'onAdded' => 'function (event) {
		// JS callback on Kudo +1 , you can do what ever you want here
		// for example send AJAX request to track stats
		var uid = $(this).data("uid");
		$.post("/kudo/plus/post/" + uid);}',
			'onRemoved' => 'function (event) {
		// JS callback on Kudo -1, send another AJAX request to track stats
		var uid = $(this).data("uid");
		$.post("/kudo/minus/post/" + uid);}',
		]);
```

Tracking and stat storage server side you should implement yourself what ever you want.

## Events

* `onActive` is sent when you hover over the object (the circle is growing)
* `onInactive` is sent when you mouse-off the object
* `onAdded` is sent when you successfully kudo something
* `onRemoved` is sent when you un-kudo something

## Advanced usage with custom icons inside widget
I am using font-smiley from [http://fontello.com/](http://fontello.com/)
Custom icon-font should be prepared and connected to the page, then you can adjust smiley look and feel via CSS
and add them inside Kudos widget like this

```php
	Kudos::widget(
		[
			'widgetId' => 'post',
			'uid' => $post->id,
			'count' => $post->kudos,
			'defaultClass' => 'icon icon-emo-thumbsup',
			'onAdded' => 'function (event) {
		var uid = $(this).data("uid");
		$(this).find(".icon").removeClass("icon-emo-thumbsup").addClass("icon-emo-beer");
		$.post("/kudo/plus/post/" + uid);}',
			'onRemoved' => 'function (event) {
		var uid = $(this).data("uid");
		$(this).find(".icon").removeClass("icon-emo-beer").addClass("icon-emo-thumbsup");
		$.post("/kudo/minus/post/" + uid);}',
		]);
```

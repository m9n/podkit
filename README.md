# Podkit. A WordPress plugin for [Pods](https://github.com/pods-framework/pods) aficionados
Podkit is a WordPress plugin aimed at developers who work with [Pods](https://github.com/pods-framework/pods).  Podkit doesn't provide any settings in WordPress.  It simply makes extra functions and shortcodes available - all aimed at helping you build (Even More) Amazing Things with Pods.  You can make use of everything Podkit provides without adding any extra code to your Plugin or Theme - it's all designed to be useful inside posts, widgets, and [Pods templates](http://pods.io/docs/build/template-tags-in-pods-templates/).

This enables me to build bespoke features on projects where it's not practical to write custom plugins or themes.  That can include multisite contexts, or ninja-like low-budget projects.

# Usage

## pk_gmap function:

Use inside a Pods template

    {@_location, pk_gmap}
    
Assuming the `_location` field contains a full address and postal code, this will return a Google Map.

## pk_dates shortcode

    [pk_dates opt="event,_start_date,_end_date" format="j F Y"]

The syntax for the first attribute is `opt="[pod name],[start date field],[end date field]"`

The format attribute needs to include month date and year, using PHP's `date()` codes.  The shortcode pays attention to the order you put the three codes in.  Currently they need to be space seperated.  In future, using forward-slashes or full-stops(periods) as seperators will allow you to format dates like this: 15.06.2017.

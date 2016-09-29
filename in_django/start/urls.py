from django.conf.urls import include, url, patterns

urlpatterns = patterns('start.views',
    url('^', 'start', name='start')
)


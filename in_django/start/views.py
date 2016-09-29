from django.shortcuts import render
from .models import Resource


# Create your views here.
def start(request):
    links = Resource.objects.order_by('dspText')[:5]
    return render(request, 'start.html', {'links': links})
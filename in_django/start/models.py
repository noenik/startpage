from django.db import models


# Create your models here.
class Category(models.Model):
    category = models.CharField(max_length=50)

    class Meta:
        db_table = 'Category'

    def __str__(self):
        return self.category


class Resource(models.Model):
    url = models.CharField(max_length=200)
    dspText = models.CharField(max_length=75)
    category = models.OneToOneField(Category)

    class Meta:
        db_table = 'Resource'

    def __str__(self):
        return self.dspText

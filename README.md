### Drupal Version
  - 8.9.2

### Installation instructions
  - Install ddev and launch the website
  - Install the custom module **representative** (found in the package **NewMode**)
  - Install the custom theme **representative_theme** (found in the package **NewMode**)
  - Clear the cache (`$ ddev ssh` and `$ drush cr`)
  - Launch the website

### Custom modules developed
  - representative

### Custom themes developed
  - representative_theme

### Application URL (localhost)
  - http://my-drupal8-site.ddev.site:8000/political-representatives/list

### Website features ####
  - Search political representatives by Canadian postal code.
    - Input with/without spaces accepted
    - Show **no result** message when the postal code is invalid or blank.
  - Search results are sorted by '*representative set*'
  - Client-side filtering
  - Client-side sorting
  - Focus the input search field by default for better User Experience
  - Paginate results

### REST API Povider ###
  - Open North Represent API

### Screen-prints ###
*1. Search Form. Focus the input search text field by default*
![alt text](https://github.com/byreshb/my-drupal8-site/blob/master/screen-prints/1_Search_Page_Default.png)

*2. Search by Canadian postal code. Default sort is by representative set in ascending order*
![alt text](https://github.com/byreshb/my-drupal8-site/blob/master/screen-prints/2_Search_By_Postal_Code_Default_Sort_Rep_Name_Asc.png)

*3. Client-side filtering*
![alt text](https://github.com/byreshb/my-drupal8-site/blob/master/screen-prints/3_Search_By_Postal_Code_Filtering.png)

*4. Client-side sorting. Sort order by is name in descending order*
![alt text](https://github.com/byreshb/my-drupal8-site/blob/master/screen-prints/4_Search_By_Postal_Code_Custom_Sort_Name_Desc.png)

*5. Search by invalid postal code*
![alt text](https://github.com/byreshb/my-drupal8-site/blob/master/screen-prints/5_Search_By_Postal_Code_Invalid_Data.png)

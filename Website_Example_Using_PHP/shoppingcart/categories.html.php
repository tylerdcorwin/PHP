<?php if (isset($allCategories)) : ?>
    <ul> 
        <li><a href="?">All</a> </li>    
        <?php foreach ($allCategories as $category): ?>
            <li>
                <?php //populate the links for the categories, part of the hidden field
                //the ?category_id links the category to the name
                ?>
                <a href="?category_id=<?php echo $category['category_id']; ?>">
        <?php echo $category['category']; ?>
                </a>
            </li>    
    <?php endforeach; ?> 
    </ul>
<?php endif; ?>
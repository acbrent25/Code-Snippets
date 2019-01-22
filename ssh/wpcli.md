wp core download


# Delete trash posts
wp post delete $(wp post list --post_status=trash --format=ids)

#delete draft posts
wp post delete $(wp post list --post_status=draft --format=ids)

# Delete draft posts and skip trash
wp post delete $(wp post list --post_status=draft --format=ids) --force

# Managing Gravity form fields
https://docs.gravityforms.com/managing-fields-wp-cli/

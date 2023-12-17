# Property Documentation

## Table: `password_resets`

| Property | Type |
| --- | --- |
| `email` | `string` |
| `token` | `string` |
| `created_at` | `timestamp` |

## Table: `failed_jobs`

| Property | Type |
| --- | --- |
| `uuid` | `string` |
| `connection` | `text` |
| `queue` | `text` |
| `payload` | `longText` |
| `exception` | `longText` |
| `failed_at` | `timestamp` |

## Table: `personal_access_tokens`

| Property | Type |
| --- | --- |
| `tokenable` | `morphs` |
| `name` | `string` |
| `token` | `string` |
| `abilities` | `text` |
| `last_used_at` | `timestamp` |
| `expires_at` | `timestamp` |

## Table: `settings`

| Property | Type |
| --- | --- |
| `key` | `string` |
| `lang` | `string` |
| `value` | `text` |

## Table: ``

| Property | Type |
| --- | --- |
| `id` | `bigIncrements` |
| `name` | `string` |
| `guard_name` | `string` |
| `model_type` | `string` |

## Table: `users`

| Property | Type |
| --- | --- |
| `name` | `string` |
| `email` | `string` |
| `phone` | `string` |
| `city` | `string` |
| `country` | `string` |
| `email_verified_at` | `timestamp` |
| `password` | `string` |
| `statut` | `string` |

## Table: `languages`

| Property | Type |
| --- | --- |
| `name` | `string` |
| `code` | `string` |
| `rtl` | `string` |
| `status` | `string` |
| `is_default` | `string` |

## Table: `pages`

| Property | Type |
| --- | --- |
| `title` | `string` |
| `slug` | `string` |
| `description` | `json` |
| `image` | `string` |
| `type` | `string` |
| `meta_title` | `string` |
| `meta_description` | `string` |
| `settings` | `json` |
| `status` | `boolean` |

## Table: `categories`

| Property | Type |
| --- | --- |
| `name` | `string` |
| `image` | `string` |
| `slug` | `string` |
| `status` | `tinyInteger` |

## Table: `services`

| Property | Type |
| --- | --- |
| `title` | `string` |
| `slug` | `string` |
| `type` | `string` |
| `image` | `string` |
| `content` | `text` |
| `features` | `json` |
| `options` | `json` |
| `status` | `boolean` |

## Table: `sliders`

| Property | Type |
| --- | --- |
| `subtitle` | `string` |
| `title` | `string` |
| `description` | `longText` |
| `image` | `string` |
| `bg_color` | `string` |
| `text_color` | `string` |
| `featured` | `boolean` |
| `link` | `string` |
| `status` | `string` |
| `embeded_video` | `text` |
| `page_id` | `foreignId` |

## Table: `sections`

| Property | Type |
| --- | --- |
| `title` | `text` |
| `image` | `string` |
| `featured_title` | `text` |
| `subtitle` | `text` |
| `label` | `text` |
| `link` | `string` |
| `description` | `text` |
| `status` | `boolean` |
| `bg_color` | `string` |
| `text_color` | `string` |
| `position` | `string` |
| `embeded_video` | `text` |
| `type` | `string` |
| `page_id` | `foreignId` |

## Table: `blog_categories`

| Property | Type |
| --- | --- |
| `title` | `string` |
| `description` | `text` |
| `status` | `boolean` |
| `featured` | `boolean` |
| `meta_title` | `text` |
| `meta_description` | `text` |

## Table: `blogs`

| Property | Type |
| --- | --- |
| `title` | `string` |
| `description` | `text` |
| `image` | `string` |
| `slug` | `string` |
| `status` | `boolean` |
| `featured` | `boolean` |
| `meta_title` | `text` |
| `meta_description` | `text` |
| `category_id` | `foreignId` |

## Table: `redirects`

| Property | Type |
| --- | --- |
| `old_url` | `string` |
| `new_url` | `string` |
| `status` | `boolean` |

## Table: `subscribers`

| Property | Type |
| --- | --- |
| `email` | `string` |
| `name` | `string` |
| `tag` | `string` |
| `status` | `boolean` |

## Table: `partners`

| Property | Type |
| --- | --- |
| `name` | `string` |
| `images` | `string` |
| `description` | `text` |
| `website_url` | `string` |
| `logo_image_url` | `string` |
| `social_media_url` | `string` |
| `status` | `boolean` |

## Table: `email_templates`

| Property | Type |
| --- | --- |
| `name` | `string` |
| `description` | `text` |
| `message` | `text` |
| `default` | `text` |
| `placeholders` | `json` |
| `type` | `string` |
| `subject` | `string` |
| `status` | `string` |

## Table: `menus`

| Property | Type |
| --- | --- |
| `name` | `string` |
| `label` | `string` |
| `url` | `string` |
| `type` | `char` |
| `placement` | `string` |
| `sort_order` | `integer` |
| `parent_id` | `integer` |
| `icon` | `string` |
| `new_window` | `boolean` |
| `status` | `integer` |

## Table: `contacts`

| Property | Type |
| --- | --- |
| `name` | `string` |
| `email` | `string` |
| `phone_number` | `string` |
| `type` | `string` |
| `subject` | `string` |
| `message` | `longText` |

## Table: `activities`

| Property | Type |
| --- | --- |
| `name` | `string` |
| `slug` | `string` |
| `description` | `longText` |
| `price` | `decimal` |
| `type` | `string` |
| `image` | `string` |
| `gallery` | `string` |
| `status` | `integer` |

## Table: `packages`

| Property | Type |
| --- | --- |
| `name` | `string` |
| `slug` | `string` |
| `description` | `text` |
| `price` | `decimal` |
| `image` | `string` |
| `gallery` | `string` |
| `activities` | `json` |
| `status` | `integer` |

## Table: `notifications`

| Property | Type |
| --- | --- |
| `id` | `uuid` |
| `type` | `string` |
| `notifiable` | `morphs` |
| `data` | `text` |
| `read_at` | `timestamp` |

## Table: `galleries`

| Property | Type |
| --- | --- |
| `tag` | `string` |
| `image` | `string` |
| `status` | `boolean` |

## Table: `pagesettings`

| Property | Type |
| --- | --- |
| `layout_type` | `string` |
| `layout_config` | `json` |
| `status` | `string` |
| `page_type` | `string` |
| `page_id` | `foreignId` |
| `activity_id` | `foreignId` |
| `package_id` | `foreignId` |
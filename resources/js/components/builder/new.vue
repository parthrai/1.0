<template>
  <div>

    <a
            :class="[{'is-editable': $builder.isEditing}, $sectionData.button.classes]"
            :href="$sectionData.button.href"
            v-html="$sectionData.button.text"
            v-styler="$sectionData.button"
    ></a>


  </div>
</template>


<script>
    import { types } from 'vuse';

    export default {
        // section name
        name: 'hero1',
        // section cover image
        cover: '../cover-hero1.png',
        // group multiple sections
        group: 'heros',
        // section data schema
        $schema: {
            // main title
            title: types.Text,
            // main content
            content: types.Text,
            // section classes
            classes: types.ClassList,
            // array of section's images
            images: [
                types.Image,
                types.Image
            ],
            // object holds button data, href etc..
            button: types.Button,
            // if section has many columns you can use
            // a columns array to separate each column's data
            columns: [
                {
                    title: types.Title,
                    content: types.Text,
                    group: types.group
                },
                {
                    title: types.Title,
                    group: types.group
                }
            ]
        },
        props: {
            id: {       type: Number,       required: false     } // it is required to have an id prop.
        }
    };
</script>

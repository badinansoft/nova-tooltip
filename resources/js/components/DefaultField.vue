<template>
  <div v-if="field.visible" :class="fieldWrapperClasses">
    <div v-if="field.withLabel" :class="labelClasses">
      <slot>
        <FormLabel
          :label-for="labelFor || field.uniqueKey"
          class="space-x-1"
          :class="{ 'mb-2': shouldShowHelpText }"
        >

            {{ fieldLabel }}

            <span v-if="field.required" class="text-red-500 text-sm">
              {{ __('*') }}
            </span>


          <Tooltip :triggers="['click']" v-if="tooltip!==''" class="inline ml-4">

            <template v-slot:content >
              <span v-html="tooltip"></span>
            </template>

            <Icon
                :solid="true"
                type="question-mark-circle"
                class="cursor-pointer text-gray-400 dark:text-gray-500"
            />

          </Tooltip>


        </FormLabel>
      </slot>
    </div>

    <div
      class="mt-1 md:mt-0 pb-5 px-6 md:px-8"
      :class="{
        'md:w-4/5': fullWidthContent,
        'md:w-3/5': !fullWidthContent,
        'w-full md:py-5': !field.stacked,
        'w-full md:pt-2': field.stacked,
      }"
    >
      <slot name="field" />

      <HelpText class="mt-2 help-text-error" v-if="showErrors && hasError">
        {{ firstError }}
      </HelpText>

      <HelpText
        class="help-text mt-2"
        v-if="shouldShowHelpText"
        v-html="field.helpText"
      />
    </div>
  </div>
</template>

<script>
import { HandlesValidationErrors, mapProps } from 'laravel-nova'

export default {
  mixins: [HandlesValidationErrors],

  props: {
    field: { type: Object, required: true },
    fieldName: { type: String },
    showErrors: { type: Boolean, default: true },
    fullWidthContent: { type: Boolean, default: false },
    labelFor: { default: null },
    ...mapProps(['showHelpText']),
  },

  computed: {
    fieldWrapperClasses() {
      // prettier-ignore
      return [
        'md:flex md:flex-row space-y-2 md:space-y-0',
        this.field.withLabel && !this.field.inline && !this.field.compact && 'py-5',
        this.field.withLabel && !this.field.inline && this.field.compact && 'py-3',
        this.field.stacked && 'md:flex-col md:space-y-2',
      ]
    },

    labelClasses() {
      // prettier-ignore
      return [
        'w-full',
        this.field.stacked && '',
        !this.field.stacked && 'md:mt-2',
        this.field.stacked && !this.field.inline && 'px-6 md:px-8',
        !this.field.stacked && !this.field.inline && 'px-6 md:px-8',
        this.field.compact && '!px-3 md:!px-6',
        !this.field.stacked && !this.field.inline && 'md:w-1/5',
      ]
    },

    controlWrapperClasses() {
      // prettier-ignore
      return [
        'w-full space-y-2',
        this.field.stacked && !this.field.inline && 'px-6 md:px-8',
        !this.field.stacked && !this.field.inline && 'px-6 md:px-8',
        this.field.compact && '!px-3 md:!px-4',
        !this.field.stacked && !this.field.inline && !this.field.fullWidth && 'md:w-3/5',
        this.field.stacked && !this.field.inline && !this.field.fullWidth && 'md:w-3/5',
        !this.field.stacked && !this.field.inline && this.field.fullWidth && 'md:w-4/5',
      ]
    },

    /**
     * Return the label that should be used for the field.
     */
    fieldLabel() {

      // If the field name is purposefully an empty string, then let's show it as such
      if (this.fieldName === '') {
        return ''
      }

      return this.fieldName || this.field.name || this.field.singularLabel
    },


    /**
     * Return the tooltip that should be used for the field.
     */
    tooltip() {
      return this.field.tooltip || ''
    },

    /**
     * Determine help text should be shown.
     */
    shouldShowHelpText() {
      return this.showHelpText && this.field.helpText?.length > 0
    },
  },
}
</script>

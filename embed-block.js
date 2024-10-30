(function (blocks, editor, components, i18n, element) {
  var el = wp.element.createElement;
  var InspectorControls = wp.blockEditor.InspectorControls;
  var TextControl = wp.components.TextControl;
  var PanelBody = wp.components.PanelBody;

  var cn_icon = el(
    "img",
    {
      src: "data:image/png;base64,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",
      style: {
        width: "20pt",
        height: "20pt",
      },
    }
  );

  blocks.registerBlockType("commonninja/embed-block", {
    title: "Common Ninja",
    description: "Embed a Common Ninja widget",
    icon: cn_icon,
    category: "embed",
    attributes: {
      pluginId: {
        type: "string",
        default: "",
      },
    },
    edit: function (props) {
      var pluginId = props.attributes.pluginId;

      return [
        el(
          InspectorControls,
          null,
          el(
            PanelBody,
            {
              title: "Widget Details",
              className: "block-commonninja-widget-details",
              initialOpen: true,
            },
            el(TextControl, {
              type: "text",
              label: "Widget ID",
              value: pluginId,
              onChange: function (newId) {
                props.setAttributes({ pluginId: newId });
              },
            })
          )
        ),
        el(
          "div",
          {
            style: {
              textAlign: "center",
              border: '1px dashed #ddd',
              padding: '10px',
              borderRadius: '3px',
            }
          },
          "The widget will be available in preview / live mode."
        ),
      ];
    },
    save: function (props) {
      // return null;
      var pluginId = props.attributes.pluginId;
      var className = "commonninja_component pid-" + pluginId;
      return wp.element.createElement("div", { className: className });
    },
  });
})(window.wp.blocks, window.wp.editor, window.wp.element, window.wp.components);

<style>
    .ui-sortable .placeholder {
        outline: 1px dashed #4183C4;
        /*-webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        margin: -1px;*/
    }

    .ui-sortable .mjs-nestedSortable-error {
        background: #fbe3e4;
        border-color: transparent;
    }

    .ui-sortable ol {
        margin: 0;
        padding: 0;
        padding-left: 30px;
    }

    ol.sortable, ol.sortable ol {
        margin: 0 0 0 25px;
        padding: 0;
        list-style-type: none;
    }

    ol.sortable {
        margin: 2em 0;
    }

    .sortable li {
        margin: 5px 0 0 0;
        padding: 0;
    }

    .sortable li div  {
        border: 1px solid #ddd;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        padding: 6px;
        margin: 0;
        cursor: move;
        background-color: #f4f4f4;
        color: #444;
        border-color: #00acd6;
    }
#toArray {margin-top: 20px;}
    .sortable li.mjs-nestedSortable-branch div {
        /*background-color: #00c0ef;*/
        /*border-color: #00acd6;*/
    }

    .sortable li.mjs-nestedSortable-leaf div {
        /*background-color: #00c0ef;*/
        border: 1px solid #ddd;
    }

    li.mjs-nestedSortable-collapsed.mjs-nestedSortable-hovering div {
        border-color: #999;
        background: #fafafa;
    }

    .ui-sortable .disclose {
        cursor: pointer;
        width: 10px;
        display: none;
    }

    .sortable li.mjs-nestedSortable-collapsed > ol {
        display: none;
    }

    .sortable li.mjs-nestedSortable-branch > div > .disclose {
        display: inline-block;
    }

    .sortable li.mjs-nestedSortable-collapsed > div > .disclose > span:before {
        content: '+ ';
    }

    .sortable li.mjs-nestedSortable-expanded > div > .disclose > span:before {
        content: '- ';
    }

    .ui-sortable h1 {
        font-size: 2em;
        margin-bottom: 0;
    }

    .ui-sortable h2 {
        font-size: 1.2em;
        font-weight: normal;
        font-style: italic;
        margin-top: .2em;
        margin-bottom: 1.5em;
    }

    .ui-sortable h3 {
        font-size: 1em;
        margin: 1em 0 .3em;;
    }

    .ui-sortable p, .ui-sortable ol, .ui-sortable ul, .ui-sortable pre, .ui-sortable form {
        margin-top: 0;
        margin-bottom: 1em;
    }

    .ui-sortable dl {
        margin: 0;
    }

    .ui-sortable dd {
        margin: 0;
        padding: 0 0 0 1.5em;
    }

    .ui-sortable code {
        background: #e5e5e5;
    }

    .ui-sortable input {
        vertical-align: text-bottom;
    }

    .ui-sortable .notice {
        color: #c33;
    }
</style>

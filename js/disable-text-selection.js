document.addEventListener('DOMContentLoaded', function() {
    const DisableTextSelectionAllowedElements = ['form', 'input', 'textarea', 'select', 'button', 'pre', 'code'];

    document.addEventListener('selectionchange', () => {
        const selection = window.getSelection();
        const selectedText = selection.toString().trim();

        if (selectedText.length > 0) {
            const selectedNode = selection.anchorNode;

            if (!DisableTextSelectionIsAllowedSelection(selectedNode)) {
                if (selectedText.length > 15) {
                    selection.removeAllRanges();
                }
            }
        }
    });

    function DisableTextSelectionIsAllowedSelection(node) {
        if (!node) return false;

        while (node) {
            if (node.nodeType === Node.ELEMENT_NODE && DisableTextSelectionAllowedElements.includes(node.tagName.toLowerCase())) {
                return true;
            }
            node = node.parentElement;
        }

        return false;
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'a' && (e.ctrlKey || e.metaKey)) {
            const activeElement = document.activeElement;

            if (DisableTextSelectionIsAllowedSelection(activeElement)) {
                return; // Allow selection
            }
            e.preventDefault();
        }
    });

    document.addEventListener('mousedown', function(e) {
        const activeElement = document.activeElement;

        if (DisableTextSelectionIsAllowedSelection(activeElement) && e.shiftKey) {
            return; // Allow selection
        }

        const targetText = e.target.innerText || e.target.value;
        const isTenDigitSelection = /\d{10}/.test(targetText);

        if (!DisableTextSelectionIsAllowedSelection(e.target)) {
            e.preventDefault();
        }
    }, true);
});
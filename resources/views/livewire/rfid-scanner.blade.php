<div class="input-icon">
    <span class="input-icon-addon" id="rfid-focus-btn" title="Click to focus RFID scanner (⌘+R or Ctrl+R)"
        style="cursor: pointer;">
        <!-- RFID Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M6 8a3 3 0 0 1 3 -3h6a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-6a3 3 0 0 1 -3 -3v-8z" />
            <path d="M10 6v2" />
            <path d="M14 6v2" />
            <path d="M12 16v.01" />
        </svg>
    </span>
    <input type="text" class="form-control" wire:model.live="rfidInput" id="rfid-input"
        placeholder="Scan RFID Card... (⌘+R or Ctrl+R)" aria-label="Scan RFID Card">
    <span class="bg-transparent border-0 input-icon-addon" title="RFID Scanner Mode">
        <span class="status-indicator" id="rfid-status"
            style="display: inline-block; width: 8px; height: 8px; border-radius: 50%; background-color: #aaa;"></span>
    </span>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('focusRfidInput', () => {
            document.getElementById('rfid-input').focus();
            updateRfidStatus(true);
        });
    });

    // Focus only when the page loads initially
    document.addEventListener('DOMContentLoaded', () => {
        // Initial setup
        const rfidInput = document.getElementById('rfid-input');
        const rfidFocusBtn = document.getElementById('rfid-focus-btn');
        const rfidStatus = document.getElementById('rfid-status');

        // Focus initially but don't force it
        setTimeout(() => {
            rfidInput.focus();
            updateRfidStatus(true);
        }, 500);

        // Update status indicator when focus changes
        rfidInput.addEventListener('focus', () => updateRfidStatus(true));
        rfidInput.addEventListener('blur', () => updateRfidStatus(false));

        // Manual focus button click
        rfidFocusBtn.addEventListener('click', () => {
            rfidInput.focus();
        });
    });

    // Add keyboard shortcut
    document.addEventListener('keydown', function(event) {
        // Command+R (Mac) or Ctrl+R (Windows/Linux) shortcut to focus on the RFID input
        if ((event.metaKey || event.ctrlKey) && event.key === 'r') {
            event.preventDefault();
            document.getElementById('rfid-input').focus();
            updateRfidStatus(true);
        }
    });

    // Update the status indicator
    function updateRfidStatus(isFocused) {
        const statusIndicator = document.getElementById('rfid-status');
        if (statusIndicator) {
            statusIndicator.style.backgroundColor = isFocused ? '#2fb344' : '#aaa'; // Green when focused, gray when not
        }
    }
</script>

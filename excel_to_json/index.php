<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convert Excel/CSV to JSON</title>
    <style>
        /* Google Fonts Import */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        /* CSS Variables for easy theming */
        :root {
            --primary-color: #007bff;
            --primary-hover-color: #0056b3;
            --light-grey: #f0f2f5;
            --dark-grey: #6c757d;
            --white: #ffffff;
            --border-color: #dee2e6;
            --border-radius: 12px;
            --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        /* Basic Body Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-grey);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        /* Main Container */
        .container {
            max-width: 500px;
            width: 100%;
            background-color: var(--white);
            padding: 40px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            text-align: center;
        }

        /* Headings and Paragraphs */
        h3 {
            margin-bottom: 1rem;
            color: #333;
            font-weight: 600;
        }

        p {
            color: var(--dark-grey);
            margin-bottom: 2rem;
        }

        /* Core Upload Area Styling */
        .upload-area {
            cursor: pointer;
            transition: background-color 0.3s, border-color 0.3s;
            margin-bottom: 2rem;
            position: relative;
        }

        /* Style for when a file is dragged over */
        .upload-area.drag-over {
            background-color: #f8f9fa;
            border-color: var(--primary-color);
        }

        .upload-area input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            /* Hide the default input */
            cursor: pointer;
        }

        .upload-icon {
            border: 2px dashed var(--border-color);
            border-radius: var(--border-radius);
            padding: 40px;
            margin-bottom: 20px;
        }

        .upload-icon svg {
            width: 48px;
            height: 48px;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .upload-text {
            font-weight: 500;
            color: #495057;
        }

        /* Display for the selected file's name */
        #file-name {
            font-weight: 500;
            color: var(--primary-color);
            margin-top: 1rem;
            display: none;
            /* Hidden by default */
        }

        /* Primary Button Styling */
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 12px 25px;
            font-size: 16px;
            font-weight: 500;
            color: var(--white);
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary:hover:not(:disabled) {
            background-color: var(--primary-hover-color);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        }

        /* Disabled state for the button */
        .btn-primary:disabled {
            background-color: #a1cfff;
            cursor: not-allowed;
            box-shadow: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Upload Your File</h3>
        <p>Convert your Excel (XLS, XLSX) or CSV files into JSON effortlessly.</p>

        <form action="convert.php" method="post" enctype="multipart/form-data" id="uploadForm">

            <label for="file-upload" class="upload-area" id="uploadArea">
                <input type="file" name="file" id="file-upload" required accept=".csv, .xls, .xlsx">

                <div class="upload-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                        <path d="M8 0a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 4.095 0 5.555 0 7.318 0 9.366 1.708 11 3.781 11H7.5V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11h4.188C14.502 11 16 9.57 16 7.773c0-1.636-1.242-2.969-2.834-3.194C12.923 1.999 10.69 0 8 0zM8.5 14.5a.5.5 0 0 1-1 0V8.707l-1.146 1.147a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V14.5z" />
                    </svg>
                </div>

                <div class="upload-text">
                    <strong>Click to upload</strong> or drag and drop.
                </div>
                <div id="file-name"></div>
            </label>

            <button type="submit" id="submit-btn" class="btn btn-primary" disabled>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
                    <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0" />
                </svg>
                Convert & Download
            </button>
        </form>
    </div>

    <script>
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('file-upload');
        const fileNameDisplay = document.getElementById('file-name');
        const submitBtn = document.getElementById('submit-btn');

        // Prevent default browser behavior for drag-and-drop
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        // Add visual styling when a file is dragged over the upload area
        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, () => {
                uploadArea.classList.add('drag-over');
            }, false);
        });

        // Remove visual styling when the file leaves the upload area
        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, () => {
                uploadArea.classList.remove('drag-over');
            }, false);
        });

        // Handle the file drop
        uploadArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            handleFiles(files);
        }

        // Handle file selection from the file input
        fileInput.addEventListener('change', function() {
            handleFiles(this.files);
        });

        // Central function to process selected/dropped files
        function handleFiles(files) {
            if (files.length > 0) {
                // We only process the first file
                fileInput.files = files; // Assign dropped files to the input
                fileNameDisplay.textContent = `File: ${files[0].name}`;
                fileNameDisplay.style.display = 'block';
                submitBtn.disabled = false; // Enable the submit button
            }
        }
    </script>
</body>

</html>
<script>
        const canvas = document.getElementById("canvas"); //document.querySelector("canvas");

        const signaturePad = new SignaturePad(canvas);

        signaturePad.addEventListener("beginStroke", () => {
            console.log("Signature started");
        }, {
            once: true
        });

        // Returns signature image as data URL (see https://mdn.io/todataurl for the list of possible parameters)
        signaturePad.toDataURL(); // save image as PNG
        signaturePad.toDataURL("image/jpeg"); // save image as JPEG
        signaturePad.toDataURL("image/jpeg", 0.5); // save image as JPEG with 0.5 image quality
        signaturePad.toDataURL("image/svg+xml"); // save image as SVG data url

        // Return svg string without converting to base64
        signaturePad.toSVG(); // "<svg...</svg>"
        signaturePad.toSVG({
            includeBackgroundColor: true
        }); // add background color to svg output

        // Draws signature image from data URL (mostly uses https://mdn.io/drawImage under-the-hood)
        // NOTE: This method does not populate internal data structure that represents drawn signature. Thus, after using #fromDataURL, #toData won't work properly.
        signaturePad.fromDataURL("data:image/png;base64,iVBORw0K...");

        // Draws signature image from data URL and alters it with the given options
        signaturePad.fromDataURL("data:image/png;base64,iVBORw0K...", {
            ratio: 1,
            width: 400,
            height: 200,
            xOffset: 100,
            yOffset: 50
        });

        // Returns signature image as an array of point groups
        const data = signaturePad.toData();

        // Draws signature image from an array of point groups
        signaturePad.fromData(data);

        // Draws signature image from an array of point groups, without clearing your existing image (clear defaults to true if not provided)
        signaturePad.fromData(data, {
            clear: false
        });

        // Clears the canvas
        signaturePad.clear();

        // Returns true if canvas is empty, otherwise returns false
        signaturePad.isEmpty();

        // Unbinds all event handlers
        signaturePad.off();

        // Rebinds all event handlers
        signaturePad.on();

        window.addEventListener("resize", resizeCanvas);
        resizeCanvas();
    </script>
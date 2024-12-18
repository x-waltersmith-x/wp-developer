# Quick Notes WordPress Plugin Test Assignment

![Sylla Logo](https://demo-main.sylla.academy/wp-content/uploads/2024/09/logo-header.svg)

## Objective
Evaluate the candidate's skills in **PHP**, **JavaScript**, **SCSS**, and **HTML**, as well as their understanding of WordPress internals and plugin development.

---

## Task Description
Create a simple WordPress plugin called **"Quick Notes"**. The plugin should allow logged-in users to add, and delete personal notes through a front-end interface.

---

## Requirements

### 1. Frontend Interface
- Create a shortcode `[quick_notes]` to display:
  - A list of the user's notes.
  - A form to add a new note (Title and Content fields).
- Notes should only be visible to the user who created them.
- Use **AJAX** for adding and deleting notes without reloading the page.
- You may use any modern CSS framework (e.g., **Bootstrap**, **TailwindCSS**) to style the front-end interface.

### 2. Backend Logic
- Store the notes in a custom database table created on plugin activation.
- The table should include:
  - **Note ID** (Primary Key)
  - **User ID** (to associate the note with the creator)
  - **Note Title**
  - **Note Content**

### 3. Localization & RTL Support
- Use WordPress localization functions (`__()` or `_e()`) to ensure all text in the plugin is translatable.
- Provide basic support for **right-to-left (RTL)** languages in your styles.

### 4. Styling
- Use **SCSS** to style the form and notes list. Compile SCSS into CSS.
- Ensure the design is **responsive** and supports both **LTR** and **RTL** layouts.

### 5. Code Quality
- Follow **WordPress coding standards**.
- Include comments in your code explaining key functionalities.

---

## Deliverables
1. A **zip file** of your plugin.
2. A brief **README file** with:
   - Installation instructions.
   - A short explanation of how your plugin works.

---

## Evaluation Criteria
- **Functionality**: Does the plugin work as expected?
- **Code Quality**: Is the code clean, well-organized, and follows WordPress standards?
- **User Experience**: Is the front-end interface simple, responsive, and visually appealing?
- **Localization**: Is the plugin fully translatable and does it support RTL?
- **Use of Modern Tools**: Is a modern CSS framework used effectively?

---

## Submission Instructions
1. **Fork this repository**.
2. Complete the assignment in your forked repository.
3. Once finished, send a link to your forked repository via email to **max@sylla.co.il**.

Good luck!

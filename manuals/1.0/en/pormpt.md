---
layout: docs-en
title: ALPS Prompt Brewery
category: Manual
permalink: /manuals/1.0/en/prompt.html
---
<style>
  /* Common Styles */
  .alps-brewery {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    line-height: 1.6;
    color: #333;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
  }
  
  .alps-brewery .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
  }
  
  .alps-brewery header {
    text-align: center;
    margin-bottom: 30px;
  }
  
  .alps-brewery .logo {
    font-size: 2.5rem;
    font-weight: bold;
    color: #336699;
    margin-bottom: 10px;
  }
  
  .alps-brewery .tagline {
    font-size: 1.2rem;
    color: #666;
  }
  
  .alps-brewery .gpts-link {
    margin-top: 10px;
    padding: 8px 12px;
    background-color: #f0f4f8;
    border-radius: 6px;
    font-size: 0.95rem;
    display: inline-block;
  }
  
  .alps-brewery .gpts-link a {
    color: #336699;
    text-decoration: none;
    font-weight: bold;
  }
  
  .alps-brewery .gpts-link a:hover {
    text-decoration: underline;
  }
  
  .alps-brewery main {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px 30px;
    margin-bottom: 40px;
  }
  
  .alps-brewery h1, .alps-brewery h2, .alps-brewery h3 {
    color: #336699;
    margin-top: 0;
  }
  
  .alps-brewery textarea {
    width: 100%;
    min-height: 200px;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-bottom: 15px;
    font-family: monospace;
    font-size: 14px;
    resize: vertical;
  }
  
  .alps-brewery button {
    background-color: #336699;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.2s;
  }
  
  .alps-brewery button:hover {
    background-color: #254e77;
  }
  
  .alps-brewery button.selected {
    background-color: #254e77;
    box-shadow: 0 0 0 2px rgba(37, 78, 119, 0.5);
  }
  
  .alps-brewery button.secondary-btn {
    background-color: #6c757d;
  }
  
  .alps-brewery button.secondary-btn:hover {
    background-color: #5a6268;
  }
  
  .alps-brewery button.copy-btn {
    background-color: #4CAF50;
    font-size: 0.9rem;
    padding: 6px 12px;
  }
  
  .alps-brewery button.copy-btn:hover {
    background-color: #3e8e41;
  }
  
  .alps-brewery .hidden {
    display: none;
  }
  
  .alps-brewery footer {
    text-align: center;
    margin-top: 20px;
    color: #666;
    font-size: 0.9rem;
  }
  
  /* Step Indicator */
  .alps-brewery .step-indicator {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
  }
  
  .alps-brewery .step {
    width: 180px;
    padding: 10px;
    text-align: center;
    background-color: #e9ecef;
    position: relative;
    z-index: 1;
  }
  
  .alps-brewery .step:not(:last-child):after {
    content: '';
    position: absolute;
    top: 50%;
    right: -15px;
    width: 30px;
    height: 2px;
    background-color: #e9ecef;
    z-index: 0;
  }
  
  .alps-brewery .step.active {
    background-color: #336699;
    color: white;
    font-weight: bold;
  }
  
  .alps-brewery .step.active:not(:last-child):after {
    background-color: #336699;
  }
  
  /* Tabs */
  .alps-brewery .tabs {
    display: flex;
    margin-bottom: 20px;
    border-bottom: 1px solid #ddd;
  }
  
  .alps-brewery .tab-btn {
    padding: 10px 20px;
    background-color: #f0f0f0;
    border: 1px solid #ddd;
    border-bottom: none;
    margin-right: 5px;
    border-radius: 5px 5px 0 0;
    cursor: pointer;
    font-weight: normal;
  }
  
  .alps-brewery .tab-btn.active {
    background-color: #336699;
    color: white;
    border-color: #336699;
    font-weight: bold;
  }
  
  .alps-brewery .tab-content {
    display: none;
    padding-top: 15px;
  }
  
  .alps-brewery .tab-content.active {
    display: block;
  }
  
  /* Section Controls */
  .alps-brewery .options-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 15px;
  }
  
  .alps-brewery .format-selection, .alps-brewery .language-selection {
    margin-bottom: 15px;
  }
  
  .alps-brewery .format-selection label, .alps-brewery .language-selection label {
    margin-right: 10px;
  }
  
  .alps-brewery select, .alps-brewery input[type="text"] {
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 0.9rem;
  }
  
  .alps-brewery .sample-controls {
    margin-bottom: 15px;
  }
  
  .alps-brewery .sample-controls select {
    width: 100%;
    max-width: 300px;
  }
  
  /* Format Buttons */
  .alps-brewery .format-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 20px;
  }
  
  /* Result Section */
  .alps-brewery .result-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
  }
  
  .alps-brewery .verification-tip {
    background-color: #f8f9fa;
    border-left: 4px solid #336699;
    padding: 10px 15px;
    margin: 15px 0;
    font-size: 0.95rem;
  }
  
  .alps-brewery .verification-tip .tip-text {
    background-color: #eef1f7;
    padding: 3px 6px;
    border-radius: 3px;
    font-family: monospace;
  }
  
  .alps-brewery .mini-btn {
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 3px;
    padding: 3px 8px;
    font-size: 0.8rem;
    cursor: pointer;
    margin-left: 5px;
    vertical-align: middle;
  }
  
  .alps-brewery .mini-btn:hover {
    background-color: #3e8e41;
  }
  
  .alps-brewery #promptResult {
    width: 100%;
    min-height: 200px;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    background-color: #f9f9f9;
    white-space: pre-wrap;
    font-family: monospace;
    font-size: 14px;
    overflow-y: auto;
    margin-bottom: 20px;
  }
  
  /* Navigation Buttons */
  .alps-brewery .nav-buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
  }
</style>

<div class="alps-brewery">
  <div class="container">
    <header>
      <div class="logo">ALPS Prompt Brewery</div>
      <div class="tagline">Brewing implementation code prompts from your user stories</div>
    </header>

    <main>
      <div class="step-indicator">
        <div class="step active" id="step1">Step 1: User Story → ALPS</div>
        <div class="step" id="step2">Step 2: ALPS → Implementation</div>
        <div class="step" id="step3">Result</div>
      </div>
      
      <!-- Step 1: User Story to ALPS Prompt -->
      <section id="userStorySection" class="section-active">
        <h2>ALPS Prompt Creation</h2>
        
        <div class="tabs">
          <button class="tab-btn active" id="userStoryTabBtn">Create from User Story</button>
          <button class="tab-btn" id="directAlpsTabBtn">Convert Existing ALPS</button>
        </div>
        
        <!-- User Story Tab Content -->
        <div id="userStoryTab" class="tab-content active">
          <div class="sample-controls">
            <label>Need inspiration?</label>
            <select id="sampleStorySelect">
              <option value="">Select a sample user story...</option>
              <optgroup label="Business Applications">
                <option value="ecommerce">E-commerce Product Management</option>
                <option value="taskapp">Task Management App</option>
                <option value="restaurant">Restaurant Reservation System</option>
              </optgroup>
              <optgroup label="Content & Information Systems">
                <option value="blog">Blog System</option>
                <option value="library">Library Management System</option>
              </optgroup>
              <optgroup label="Service Industries">
                <option value="travel">Travel Booking System</option>
                <option value="events">Event Management Platform</option>
                <option value="healthcare">Healthcare Patient Management</option>
              </optgroup>
            </select>
          </div>
          
          <textarea id="userStoryInput" placeholder="Enter your user story or system requirements here..."></textarea>
          
          <div class="options-row">
            <div class="format-selection">
              <label>ALPS Format:</label>
              <label><input type="radio" name="alpsFormat" value="json" checked> JSON</label>
              <label><input type="radio" name="alpsFormat" value="xml"> XML</label>
            </div>
            
            <div class="language-selection">
              <label>Documentation Language:</label>
              <select id="languageSelect">
                <option value="English">English</option>
                <option value="Japanese">Japanese</option>
                <option value="Spanish">Spanish</option>
                <option value="French">French</option>
                <option value="German">German</option>
                <option value="Chinese">Chinese</option>
                <option value="other">Other...</option>
              </select>
              <input type="text" id="customLanguage" placeholder="Specify language" class="hidden">
            </div>
          </div>
          
          <button id="generateAlpsPromptBtn" class="primary-btn">Generate ALPS Prompt</button>
        </div>
        
        <!-- Direct ALPS Tab Content -->
        <div id="directAlpsTab" class="tab-content">
          <p>Paste your existing ALPS profile below and proceed directly to the format conversion step.</p>
          <textarea id="directAlpsInput" placeholder="Paste your existing ALPS profile here..."></textarea>
          <div class="format-selection">
            <label>Select the format of your ALPS profile:</label>
            <label><input type="radio" name="directAlpsFormat" value="json" checked> JSON</label>
            <label><input type="radio" name="directAlpsFormat" value="xml"> XML</label>
          </div>
          <button id="proceedToConversionBtn" class="primary-btn">Proceed to Conversion</button>
        </div>
      </section>
      
      <!-- Step 2: ALPS to Implementation -->
      <section id="alpsSection" class="hidden">
        <h2>Convert ALPS to Implementation Format</h2>
        
        <div class="result-header">
          <h3>Generated ALPS Prompt</h3>
          <button id="copyAlpsBtn" class="copy-btn">Copy ALPS Prompt</button>
        </div>
        
        <textarea id="alpsInput" placeholder="Your generated ALPS prompt will appear here. You can also paste your own ALPS profile."></textarea>
        
        <div class="verification-tip">
          <p><strong>💡 Pro Tip:</strong> After receiving your ALPS profile from the AI, consider asking: <span class="tip-text">"Please verify all links and references in this ALPS profile and fix any inconsistencies."</span> <button id="copyTipBtn" class="mini-btn">Copy Tip</button></p>
        </div>
        
        <h3>Select Target Implementation Format</h3>
        <div class="format-buttons">
          <button id="openApiBtn">OpenAPI</button>
          <button id="jsonSchemaBtn">JSON Schema</button>
          <button id="graphqlBtn">GraphQL</button>
          <button id="sqlBtn">SQL</button>
          <button id="typescriptBtn">TypeScript</button>
        </div>
        
        <button id="convertAlpsBtn" class="primary-btn">Generate Conversion Prompt</button>
        
        <div class="nav-buttons">
          <button id="backToUserStoryBtn" class="secondary-btn">← Back to User Story</button>
        </div>
      </section>
      
      <!-- Step 3: Result -->
      <section id="resultSection" class="hidden">
        <div class="result-header">
          <h2 id="resultTitle">Generated Conversion Prompt</h2>
          <button id="copyResultBtn" class="copy-btn">Copy to Clipboard</button>
        </div>
        
        <p>Copy this prompt to ChatGPT, Claude, or any other AI assistant:</p>
        <div id="promptResult"></div>
        
        <div class="verification-tip">
          <p><strong>💡 Remember:</strong> For best results, first have the AI verify the ALPS profile for correctness, then provide this conversion prompt.</p>
        </div>
        
        <div class="nav-buttons">
          <button id="startOverBtn" class="secondary-btn">Start Over</button>
          <button id="backToAlpsBtn" class="secondary-btn">← Back to ALPS</button>
        </div>
        
        <div class="gpts-link" style="margin-top: 25px; text-align: center;">
          <p>Tip: For quick results, you can also use <a href="https://chatgpt.com/g/g-HYPygRnLS-alps-assistant" target="_blank">ALPS Assistant GPTs</a> with your prompts.</p>
        </div>
      </section>
    </main>
    
    <footer>
    </footer>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const userStoryInput = document.getElementById('userStoryInput');
    const alpsInput = document.getElementById('alpsInput');
    const promptResult = document.getElementById('promptResult');
    const resultTitle = document.getElementById('resultTitle');
    
    // Sections
    const userStorySection = document.getElementById('userStorySection');
    const alpsSection = document.getElementById('alpsSection');
    const resultSection = document.getElementById('resultSection');
    
    // Step indicators
    const step1 = document.getElementById('step1');
    const step2 = document.getElementById('step2');
    const step3 = document.getElementById('step3');
    
    // Buttons
    const generateAlpsPromptBtn = document.getElementById('generateAlpsPromptBtn');
    const convertAlpsBtn = document.getElementById('convertAlpsBtn');
    const copyAlpsBtn = document.getElementById('copyAlpsBtn');
    const copyResultBtn = document.getElementById('copyResultBtn');
    const backToUserStoryBtn = document.getElementById('backToUserStoryBtn');
    const backToAlpsBtn = document.getElementById('backToAlpsBtn');
    const startOverBtn = document.getElementById('startOverBtn');
    
    // Format buttons
    const openApiBtn = document.getElementById('openApiBtn');
    const jsonSchemaBtn = document.getElementById('jsonSchemaBtn');
    const graphqlBtn = document.getElementById('graphqlBtn');
    const sqlBtn = document.getElementById('sqlBtn');
    const typescriptBtn = document.getElementById('typescriptBtn');
    
    // Sample user stories
    const sampleStories = {
      'ecommerce': `As a store owner, I want to manage product inventory.
Products have a name, description, price, category, and stock quantity.
I need to add new products, update existing ones, and remove discontinued items.
Customers should be able to browse products by category and view product details.`,
      
      'taskapp': `As a project manager, I need a task tracking system.
Tasks have a title, description, due date, priority, and assigned user.
Users should be able to create tasks, update status, and mark them complete.
The system should display task lists filtered by status or assigned user.`,
      
      'blog': `As a content creator, I need a blog management system.
Articles have a title, content, publication date, tags, and author.
I want to create drafts, publish articles, and manage comments.
Readers should be able to view articles by tag or author and leave comments.`,
      
      'travel': `As a travel agent, I need a booking management system.
Trips have destinations, departure/arrival dates, transportation type, and accommodations.
Customers have personal details, payment information, and travel preferences.
Agents should be able to search for available trips, make reservations, and manage itineraries.
The system needs to track booking status, payments, and send confirmation notifications.`,
      
      'healthcare': `As a clinic administrator, I need a patient management system.
Patients have personal information, medical history, and insurance details.
Appointments have a date, time, doctor, patient, and status.
Medical staff need to schedule appointments, record diagnoses, and manage prescriptions.
Patients should be able to view their medical records and upcoming appointments.`,
      
      'events': `As an event planner, I need an event management platform.
Events have a name, venue, date, time, capacity, and ticket types.
Attendees can purchase tickets, register for sessions, and leave feedback.
Organizers need to manage venues, speakers, schedules, and ticket sales.
The system should support check-ins, send reminders, and generate attendance reports.`,
      
      'library': `As a librarian, I need a library management system.
Books have titles, authors, genres, ISBN, publication dates, and availability status.
Members have accounts with personal information, borrowed books, and borrowing history.
Librarians need to catalog books, process loans and returns, and manage reservations.
Members should be able to search the catalog, reserve books, and view their account status.`,
      
      'restaurant': `As a restaurant owner, I need a reservation and ordering system.
Tables have capacity, location, and availability status.
Menu items have names, descriptions, prices, categories, and dietary information.
Staff need to manage reservations, take orders, and process payments.
Customers should be able to book tables, browse menus, and place orders.`
    };
    
    // ALPS guide content (abbreviated version of llms-full.txt)
    const alpsGuide = `## ‼️ Important: JSON Format Guidelines ‼️

1. Write each descriptor on a single line (mandatory).
2. Only indent and line-break descriptors if they contain other descriptors.
3. All nested descriptors must reference their parent with \`href\`.

\`\`\`json
{"$schema": "https://alps-io.github.io/schemas/alps.json", "alps": {"version": "1.0", "descriptor": [
{"id": "name", "type": "semantic", "title": "Name", "def": "https://schema.org/name"},
{"id": "email", "type": "semantic", "title": "Email", "def": "https://schema.org/email"},
{"id": "User", "type": "semantic", "title": "User Profile", "descriptor": [
  {"href": "#name"},
  {"href": "#email"}
]},
{"id": "UserList", "type": "semantic", "title": "User List", "descriptor": [
  {"href": "#User"},
  {"href": "#goUser"},
  {"href": "#doCreateUser"}
]},
{"id": "goUser", "type": "safe", "title": "View User Details", "rt": "#User"},
{"id": "doCreateUser", "type": "unsafe", "title": "Create User", "rt": "#UserList"}
]}}
\`\`\`

## XML Format Guidelines

- Use indentation to indicate hierarchy.
- Write each element on a single line.

\`\`\`xml
<alps version="1.0"
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
  xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
</alps>
\`\`\`

## Structuring Semantic Descriptors

Organize into the following three blocks. Each descriptor must either reference or contain other descriptors:

1. Semantic Definitions (Ontology)
   - Define basic elements (lowerCamelCase).
   - Always specify \`def\` as a full URL if there's a Schema.org definition.
   - Add a \`title\` to all descriptors.
   - Include \`doc\` only if necessary.
   - Each defined element must be referenced by at least one taxonomy state.

2. Containment Relationships (Taxonomy)
   - Descriptors representing states use UpperCamelCase.
   - Use \`href\` for referencing elements (direct definition via \`id\` is not allowed).
   - Each application state includes:
     * Elements displayed/used in the state (defined in the ontology).
     * Actions that can be performed (defined in choreography).
   - Use \`doc\` for additional details if needed.
   - Each taxonomy must either contain or transition to other taxonomies.

3. State Transitions (Choreography)
   - Define transition actions.
   - Select the appropriate \`type\` attribute.
   - Specify the transition destination (\`rt\`).
   - Use \`href\` to refer to necessary data items.
   - Each operation must be referenced by at least one taxonomy state.`;
    
    // Conversion prompt templates
    const conversionPrompts = {
      'OpenAPI': `**Task:** Convert the provided ALPS (Application-Level Profile Semantics) file into an OpenAPI 3.0 definition file in YAML format.

**Key Points to Consider:**

1. **Descriptor Elements:**
    - **Understanding \`descriptor\`:** In ALPS, a \`descriptor\` represents a semantic element, which can be a data element or a state transition.
    - **Mapping to OpenAPI Paths and Operations:**
        - For state transitions (\`descriptor\` with \`type\` of \`safe\`, \`unsafe\`, or \`idempotent\`), map these to OpenAPI operations under appropriate HTTP methods (\`GET\`, \`POST\`, \`PUT\`, \`DELETE\`).
        - Ensure idempotent operations use \`PUT\` or \`DELETE\`.
        - Do not include a request body for \`DELETE\` operations.

2. **Components and Reusability:**
    - **Schemas and Parameters:**
        - Extract data element descriptors (those with \`type\` of \`semantic\`) and define them as reusable schemas under \`components/schemas\`.
        - Use these schemas in request bodies and responses where applicable.
    - **Common Parameters:**
        - Identify common parameters (e.g., IDs, query parameters) and define them under \`components/parameters\` for reuse.

3. **Responses and Status Codes:**
    - **Appropriate Status Codes:**
        - Use \`200 OK\` for successful retrieval.
        - Use \`201 Created\` when a new resource is created.
        - Use \`204 No Content\` when an operation is successful but does not return content.
        - Use \`400 Bad Request\`, \`404 Not Found\`, etc., for error handling.
    - **Response Schemas:**
        - Define response schemas using the components defined earlier.

4. **Data Constraints:**
    - **Validation:**
        - Add data constraints such as:
            - **String Constraints:** \`minLength\`, \`maxLength\`, \`pattern\` (regular expressions).
            - **Numeric Constraints:** \`minimum\`, \`maximum\`.
            - **Enumerations:** \`enum\` for fixed sets of values.
    - **Applying Constraints:**
        - Apply these constraints to the schemas in \`components/schemas\`.

5. **Links and External Documentation:**
    - **Link Relations:**
        - If the \`descriptor\` includes \`href\` or \`rel\`, consider using OpenAPI's \`externalDocs\` or \`links\` to represent relationships.
    - **Descriptions:**
        - Use the \`doc\` element in ALPS to provide descriptions for operations, parameters, and schemas.

**Output Format:**
- Provide the OpenAPI definition in **YAML** format.`,
      
      'JSON Schema': `**Task:** Convert the provided ALPS (Application-Level Profile Semantics) file into a JSON Schema definition.

**Key Points to Consider:**

1. **Descriptor Elements:**
    - **Understanding \`descriptor\`:** In ALPS, a \`descriptor\` represents a semantic element.
    - **Mapping to JSON Schema:**
        - Map data elements (\`descriptor\` with \`type\` of \`semantic\`) to JSON Schema properties.
        - Use appropriate JSON Schema types based on the data element's nature.

2. **Schema Structure:**
    - **Root Schema:**
        - Define the root schema with \`$schema\` and \`type\` properties.
        - Include appropriate metadata like \`title\` and \`description\`.
    - **Properties:**
        - Define properties based on ALPS descriptors.
        - Organize nested structures using \`properties\` and \`items\`.

3. **Data Types and Formats:**
    - **Basic Types:**
        - Use appropriate JSON Schema types:
            - \`string\`
            - \`number\`
            - \`integer\`
            - \`boolean\`
            - \`object\`
            - \`array\`
    - **Formats:**
        - Apply standard formats where applicable:
            - \`date-time\`
            - \`date\`
            - \`email\`
            - \`uri\`
            - etc.

4. **Data Constraints:**
    - **Validation Rules:**
        - Add constraints such as:
            - **Strings:** \`minLength\`, \`maxLength\`, \`pattern\`
            - **Numbers:** \`minimum\`, \`maximum\`, \`multipleOf\`
            - **Arrays:** \`minItems\`, \`maxItems\`, \`uniqueItems\`
            - **Objects:** \`required\`, \`additionalProperties\`
    - **Enumerations:**
        - Use \`enum\` for fixed sets of values
        - Include descriptions for enum values

5. **Definitions and References:**
    - **Reusable Components:**
        - Define common schemas under \`$defs\`
        - Use \`$ref\` to reference reusable schemas
    - **Inheritance:**
        - Use \`allOf\`, \`anyOf\`, or \`oneOf\` for complex type relationships

6. **Documentation:**
    - **Descriptions:**
        - Use ALPS \`doc\` elements for schema and property descriptions
    - **Examples:**
        - Include \`examples\` where helpful
    - **Titles:**
        - Add clear titles for properties and definitions`,
      
      'GraphQL': `**Task:** Convert the provided ALPS (Application-Level Profile Semantics) file into a complete GraphQL implementation including schema definitions and operation examples.

**Key Points to Consider:**

1. **Schema Definition:**
   - **Type Definitions:**
     - Map ALPS semantic descriptors to GraphQL types
     - Use appropriate scalar types (ID, String, Int, Float, Boolean)
     - Define custom scalar types if needed (DateTime, JSON, etc.)

   - **Relationships:**
     - Handle one-to-one, one-to-many, and many-to-many relationships
     - Consider nullable vs. non-nullable fields

   - **Input Types:**
     - Create input types for mutations
     - Consider validation requirements

   - **Interfaces and Unions:**
     - Define interfaces for shared fields
     - Use unions for polymorphic relationships

2. **Query Operations:**
   - **Base Queries:**
     - Single item retrieval
     - List retrieval with filtering
     - Search operations

   - **Filtering System:**
     - Define filter input types
     - Support complex filtering operations

   - **Pagination:**
     - Implement cursor-based pagination
     - Support limit/offset pagination

3. **Mutation Operations:**
   - **Create Operations:**
     - Include proper input validation
     - Return meaningful payloads with error handling

   - **Batch Operations:**
     - Support batch create/update/delete operations

   - **Error Handling:**
     - Define proper error handling structures
     - Include field-level errors

4. **Subscription Operations:**
   - Define event-based subscriptions for real-time updates

5. **Directives:**
   - Add appropriate directives for authorization, deprecation, etc.`,
      
      'SQL': `**Task:** Convert the provided ALPS (Application-Level Profile Semantics) file into SQL DDL (Data Definition Language) and DML (Data Manipulation Language) statements.

**Part 1: DDL Statements**

1. **Schema and Table Design:**
   - **Database Schema:**
      - Create an appropriate database schema name based on the ALPS profile
      - Include schema versioning considerations
   - **Table Creation:**
      - Map ALPS descriptors with \`type\` of \`semantic\` to database tables
      - Handle nested structures through table relationships

**Part 2: DML Statement Generation**

1. **SELECT Queries:**
    - **Basic Queries:**
        - Generate SELECT statements for each main resource
        - Include appropriate JOIN clauses based on relationships
        - Add WHERE clauses for filtering
        - Consider pagination (LIMIT/OFFSET)

    - **Complex Queries:**
        - Create queries with multiple JOINs
        - Add subqueries where appropriate
        - Include aggregate functions (COUNT, SUM, etc.)
        - Implement GROUP BY and HAVING clauses

    - **View Queries:**
        - Generate useful view definitions
        - Create materialized views for performance

2. **INSERT Statements:**
    - Generate INSERT statements with:
        - Single row insertions
        - Bulk insert templates
        - INSERT ... SELECT patterns
        - RETURNING clauses where applicable

3. **UPDATE Statements:**
    - Create UPDATE templates for:
        - Single record updates
        - Bulk updates
        - Updates with JOINs
        - Conditional updates

4. **DELETE Statements:**
    - Generate DELETE statements with:
        - Safe deletion patterns
        - Soft delete implementations
        - Cascade delete considerations
        - Archive strategies`,
      
      'TypeScript': `**Task:** Convert the provided ALPS (Application-Level Profile Semantics) file into TypeScript type definitions, interfaces, and related utilities.

**Part 1: Core Type Definitions**

1. **Base Types and Interfaces:**
    - **Entity Types:**
        - Create interfaces for main entities
        - Include proper type annotations
        - Use enums for finite value sets

    - **Nested Types:**
        - Handle nested structures through composition
        - Use extension for related types

2. **Utility Types:**
    - **Partial Types:**
        - Create update payload types
        - Omit appropriate fields

    - **Pick Types:**
        - Create specialized subsets of types
        - Use for specific operations

    - **Record Types:**
        - Create lookup collections

3. **Generic Types:**
    - **Response Wrappers:**
        - Create pagination wrappers
        - Design proper error handling types

**Part 2: API Types**

1. **Request/Response Types:**
    - Define request payloads
    - Define response structures
    - Include proper validation constraints

2. **Query Parameters:**
    - Define search parameter types
    - Include sorting and filtering options

3. **API Client Types:**
    - Define service interfaces
    - Include proper error handling

**Part 3: Validation Schemas**

1. **Zod Schemas:**
    - Define validation schemas
    - Infer types from schemas

2. **Custom Validators:**
    - Create type guards
    - Include proper error reporting`
    };
    
    // Tab switching functionality
    document.getElementById('userStoryTabBtn').addEventListener('click', function() {
      document.getElementById('userStoryTab').classList.add('active');
      document.getElementById('directAlpsTab').classList.remove('active');
      this.classList.add('active');
      document.getElementById('directAlpsTabBtn').classList.remove('active');
    });
    
    document.getElementById('directAlpsTabBtn').addEventListener('click', function() {
      document.getElementById('directAlpsTab').classList.add('active');
      document.getElementById('userStoryTab').classList.remove('active');
      this.classList.add('active');
      document.getElementById('userStoryTabBtn').classList.remove('active');
    });
    
    // STEP 1: Sample story handling
    document.getElementById('sampleStorySelect').addEventListener('change', function() {
      if (this.value) {
        userStoryInput.value = sampleStories[this.value];
      }
    });
    
    // Custom language handling
    document.getElementById('languageSelect').addEventListener('change', function() {
      const customLanguageInput = document.getElementById('customLanguage');
      if (this.value === 'other') {
        customLanguageInput.classList.remove('hidden');
      } else {
        customLanguageInput.classList.add('hidden');
      }
    });
    
    // Generate ALPS Prompt button (from user story)
    generateAlpsPromptBtn.addEventListener('click', function() {
      if (userStoryInput.value.trim() === '') {
        alert('Please enter a user story.');
        return;
      }
      
      const format = document.querySelector('input[name="alpsFormat"]:checked').value;
      const language = getSelectedLanguage();
      
      // Generate ALPS prompt
      const alpsPrompt = generateAlpsPrompt(userStoryInput.value, format, language);
      alpsInput.value = alpsPrompt;
      
      // Move to Step 2
      userStorySection.classList.add('hidden');
      alpsSection.classList.remove('hidden');
      
      step1.classList.remove('active');
      step2.classList.add('active');
    });
    
    // Proceed to conversion button (from direct ALPS input)
    document.getElementById('proceedToConversionBtn').addEventListener('click', function() {
      const directAlpsInput = document.getElementById('directAlpsInput');
      
      if (directAlpsInput.value.trim() === '') {
        alert('Please enter an ALPS profile.');
        return;
      }
      
      // Transfer direct ALPS input to the conversion section
      alpsInput.value = directAlpsInput.value;
      
      // Move directly to Step 2
      userStorySection.classList.add('hidden');
      alpsSection.classList.remove('hidden');
      
      step1.classList.remove('active');
      step2.classList.add('active');
    });
    
    // STEP 2: Format selection handling
    let selectedFormat = null;
    
    openApiBtn.addEventListener('click', () => selectFormat('OpenAPI', openApiBtn));
    jsonSchemaBtn.addEventListener('click', () => selectFormat('JSON Schema', jsonSchemaBtn));
    graphqlBtn.addEventListener('click', () => selectFormat('GraphQL', graphqlBtn));
    sqlBtn.addEventListener('click', () => selectFormat('SQL', sqlBtn));
    typescriptBtn.addEventListener('click', () => selectFormat('TypeScript', typescriptBtn));
    
    function selectFormat(format, button) {
      selectedFormat = format;
      
      // Update UI to show selected format
      document.querySelectorAll('.format-buttons button').forEach(btn => {
        btn.classList.remove('selected');
      });
      button.classList.add('selected');
    }
    
    // Convert ALPS button
    convertAlpsBtn.addEventListener('click', function() {
      if (alpsInput.value.trim() === '') {
        alert('Please generate or paste an ALPS profile.');
        return;
      }
      
      if (!selectedFormat) {
        alert('Please select a format to convert to.');
        return;
      }
      
      // Generate conversion prompt
      const conversionPrompt = conversionPrompts[selectedFormat] + 
        '\n\n_YOUR_ALPS_HERE_\n\n```\n' + alpsInput.value + '\n```';
      
      promptResult.textContent = conversionPrompt;
      resultTitle.textContent = `${selectedFormat} Conversion Prompt`;
      
      // Move to Step 3
      alpsSection.classList.add('hidden');
      resultSection.classList.remove('hidden');
      
      step2.classList.remove('active');
      step3.classList.add('active');
    });
    
    // Navigation buttons
    backToUserStoryBtn.addEventListener('click', function() {
      alpsSection.classList.add('hidden');
      userStorySection.classList.remove('hidden');
      
      step2.classList.remove('active');
      step1.classList.add('active');
    });
    
    backToAlpsBtn.addEventListener('click', function() {
      resultSection.classList.add('hidden');
      alpsSection.classList.remove('hidden');
      
      step3.classList.remove('active');
      step2.classList.add('active');
    });
    
    startOverBtn.addEventListener('click', function() {
      resultSection.classList.add('hidden');
      userStorySection.classList.remove('hidden');
      
      step3.classList.remove('active');
      step1.classList.add('active');
      step2.classList.remove('active');
      
      // Reset selections
      selectedFormat = null;
      document.querySelectorAll('.format-buttons button').forEach(btn => {
        btn.classList.remove('selected');
      });
    });
    
    // Copy buttons
    copyAlpsBtn.addEventListener('click', function() {
      copyToClipboard(alpsInput.value, copyAlpsBtn);
    });
    
    copyResultBtn.addEventListener('click', function() {
      copyToClipboard(promptResult.textContent, copyResultBtn);
    });
    
    // Copy verification tip
    document.getElementById('copyTipBtn').addEventListener('click', function() {
      const tipText = "Please verify all links and references in this ALPS profile and fix any inconsistencies.";
      copyToClipboard(tipText, this);
    });
    
    // Helper functions
    function getSelectedLanguage() {
      const languageSelect = document.getElementById('languageSelect');
      if (languageSelect.value === 'other') {
        return document.getElementById('customLanguage').value || 'Custom';
      } else {
        return languageSelect.value;
      }
    }
    
    function generateAlpsPrompt(userStory, format, language) {
      return `# ALPS Profile Creation Prompt

Create an ALPS profile based on the following requirements, adhering to the guidelines described below:

* Format: ${format.toUpperCase()}
* Language: ${language}
* Content: 

${userStory}

${alpsGuide}`;
    }
    
    function copyToClipboard(text, button) {
      navigator.clipboard.writeText(text)
        .then(() => {
          const originalText = button.textContent;
          button.textContent = '✅ Copied!';
          setTimeout(() => {
            button.textContent = originalText;
          }, 2000);
        })
        .catch(err => {
          console.error('Failed to copy: ', err);
          alert('Failed to copy. Please copy manually.');
        });
    }
  });
</script>

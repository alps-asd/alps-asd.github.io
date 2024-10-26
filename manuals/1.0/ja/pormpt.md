---
layout: docs-ja
title: プロンプト
category: Manual
permalink: /manuals/1.0/ja/prompt.html
---

# プロンプト
a
OpenAPI、GraphQL、SQLなど、システムの具体的な実装定義は多くの詳細を含むため煩雑になりがちです。一方、ALPSはセマンティックな記述によって、システムのコアとなる情報設計を抽象度高く表現できます。

この抽象的な表現は、AIとの効率的なコミュニケーションを可能にし、API仕様、データベーススキーマ、型定義など、様々な具体的な実装形式を容易にします。ここで紹介するプロンプトを活用することで、ALPSから各種実装定義を効率的に生成できます。

## 変換プロンプト一覧

- [OpenAPI](#openapi)
- [JSON Schema](#jsonスキーマ)
- [GraphQL](#graphql)
- [SQL](#sql)
- [TypeScript type definitions](#typescript-type-definitions)

## OpenAPI

<pre>
**Task:** Convert the provided ALPS (Application-Level Profile Semantics) file into an OpenAPI 3.0 definition file in YAML format.

**Key Points to Consider:**

1. **Descriptor Elements:**
    - **Understanding `descriptor`:** In ALPS, a `descriptor` represents a semantic element, which can be a data element or a state transition.
    - **Mapping to OpenAPI Paths and Operations:**
        - For state transitions (`descriptor` with `type` of `safe`, `unsafe`, or `idempotent`), map these to OpenAPI operations under appropriate HTTP methods (`GET`, `POST`, `PUT`, `DELETE`).
        - Ensure idempotent operations use `PUT` or `DELETE`.
        - Do not include a request body for `DELETE` operations.

2. **Components and Reusability:**
    - **Schemas and Parameters:**
        - Extract data element descriptors (those with `type` of `semantic`) and define them as reusable schemas under `components/schemas`.
        - Use these schemas in request bodies and responses where applicable.
    - **Common Parameters:**
        - Identify common parameters (e.g., IDs, query parameters) and define them under `components/parameters` for reuse.

3. **Responses and Status Codes:**
    - **Appropriate Status Codes:**
        - Use `200 OK` for successful retrieval.
        - Use `201 Created` when a new resource is created.
        - Use `204 No Content` when an operation is successful but does not return content.
        - Use `400 Bad Request`, `404 Not Found`, etc., for error handling.
    - **Response Schemas:**
        - Define response schemas using the components defined earlier.

4. **Data Constraints:**
    - **Validation:**
        - Add data constraints such as:
            - **String Constraints:** `minLength`, `maxLength`, `pattern` (regular expressions).
            - **Numeric Constraints:** `minimum`, `maximum`.
            - **Enumerations:** `enum` for fixed sets of values.
    - **Applying Constraints:**
        - Apply these constraints to the schemas in `components/schemas`.

5. **Links and External Documentation:**
    - **Link Relations:**
        - If the `descriptor` includes `href` or `rel`, consider using OpenAPI's `externalDocs` or `links` to represent relationships.
    - **Descriptions:**
        - Use the `doc` element in ALPS to provide descriptions for operations, parameters, and schemas.

**Output Format:**
- Provide the OpenAPI definition in **YAML** format.

---

**Additional Notes:**

- Focus on accurately translating the ALPS descriptors into OpenAPI paths, operations, and components.
- Ensure that the resulting OpenAPI file is valid and follows best practices.
- Do not include unnecessary information from the ALPS file that does not contribute to the OpenAPI definition.


_YOUR_ALPS_HERE_
</pre>

## JSONスキーマ

<pre>
**Task:** Convert the provided ALPS (Application-Level Profile Semantics) file into a JSON Schema definition.

**Key Points to Consider:**

1. **Descriptor Elements:**
    - **Understanding `descriptor`:** In ALPS, a `descriptor` represents a semantic element.
    - **Mapping to JSON Schema:**
        - Map data elements (`descriptor` with `type` of `semantic`) to JSON Schema properties.
        - Use appropriate JSON Schema types based on the data element's nature.

2. **Schema Structure:**
    - **Root Schema:**
        - Define the root schema with `$schema` and `type` properties.
        - Include appropriate metadata like `title` and `description`.
    - **Properties:**
        - Define properties based on ALPS descriptors.
        - Organize nested structures using `properties` and `items`.

3. **Data Types and Formats:**
    - **Basic Types:**
        - Use appropriate JSON Schema types:
            - `string`
            - `number`
            - `integer`
            - `boolean`
            - `object`
            - `array`
    - **Formats:**
        - Apply standard formats where applicable:
            - `date-time`
            - `date`
            - `email`
            - `uri`
            - etc.

4. **Data Constraints:**
    - **Validation Rules:**
        - Add constraints such as:
            - **Strings:** `minLength`, `maxLength`, `pattern`
            - **Numbers:** `minimum`, `maximum`, `multipleOf`
            - **Arrays:** `minItems`, `maxItems`, `uniqueItems`
            - **Objects:** `required`, `additionalProperties`
    - **Enumerations:**
        - Use `enum` for fixed sets of values
        - Include descriptions for enum values

5. **Definitions and References:**
    - **Reusable Components:**
        - Define common schemas under `$defs`
        - Use `$ref` to reference reusable schemas
    - **Inheritance:**
        - Use `allOf`, `anyOf`, or `oneOf` for complex type relationships

6. **Documentation:**
    - **Descriptions:**
        - Use ALPS `doc` elements for schema and property descriptions
    - **Examples:**
        - Include `examples` where helpful
    - **Titles:**
        - Add clear titles for properties and definitions

**Output Format:**
- Provide the JSON Schema in standard JSON format
- Use proper indentation for readability

**Additional Requirements:**
- The schema should be valid against JSON Schema Draft 2020-12
- Include appropriate `required` properties
- Use meaningful property names
- Add comments for complex validations or business rules

_YOUR_ALPS_HERE_
</pre>

## SQL

<pre>
**Task:** Convert the provided ALPS (Application-Level Profile Semantics) file into SQL DDL (Data Definition Language) and DML (Data Manipulation Language) statements.

**Part 1: DDL Statements**

1. **Schema and Table Design:**
   - **Database Schema:**
      - Create an appropriate database schema name based on the ALPS profile
      - Include schema versioning considerations
   - **Table Creation:**
      - Map ALPS descriptors with `type` of `semantic` to database tables
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

    - Include:
        - WHERE clauses for safe updates
        - UPDATE triggers consideration
        - Optimistic locking patterns

4. **DELETE Statements:**
    - Generate DELETE statements with:
        - Safe deletion patterns
        - Soft delete implementations
        - Cascade delete considerations
        - Archive strategies

5. **Transaction Patterns:**
    - Create transaction templates for:
        - Complex operations
        - Data consistency
        - Error handling
        - Rollback scenarios

6. **Common Query Patterns:**
    - **Search:**
        - Full-text search queries
        - Pattern matching (LIKE/ILIKE)
        - Fuzzy matching

    - **Reporting:**
        - Summary queries
        - Time-based aggregations
        - Cross-table analytics

    - **Audit:**
        - Change tracking queries
        - History viewing
        - Activity logs

**Output Format Requirements:**

1. **DDL Format:**
    - Complete CREATE statements
    - Index definitions
    - Constraint definitions
    - Comment blocks explaining design decisions

2. **DML Format:**
    - Parameterized queries using :param or $n notation
    - Comments explaining complex logic
    - Performance considerations
    - Expected index usage

3. **Query Organization:**
    - Group related queries together
    - Include use case descriptions
    - Document expected results
    - Note any specific database engine requirements

**Additional Considerations:**

1. **Performance:**
    - Index usage hints
    - EXPLAIN plan considerations
    - Query optimization suggestions
    - Batch processing patterns

2. **Security:**
    - SQL injection prevention
    - Permission requirements
    - Row-level security patterns
    - Audit trail implementation

3. **Maintainability:**
    - Clear query structure
    - Consistent naming conventions
    - Reusable components (CTEs, Views)
    - Documentation of complex logic

4. **Error Handling:**
    - EXCEPTION blocks
    - Transaction management
    - Deadlock handling
    - Constraint violation handling

_YOUR_ALPS_HERE_
</pre>

## GraphQL

<pre>

**Task:** Convert the provided ALPS (Application-Level Profile Semantics) file into a complete GraphQL implementation including schema definitions and operation examples.

**Key Points to Consider:**

1. **Schema Definition:**
   - **Type Definitions:**
     - Map ALPS semantic descriptors to GraphQL types
     - Use appropriate scalar types (ID, String, Int, Float, Boolean)
     - Define custom scalar types if needed (DateTime, JSON, etc.)
     ```graphql
     scalar DateTime
     scalar JSON

     type User {
       id: ID!
       name: String!
       email: String!
       createdAt: DateTime!
       metadata: JSON
     }
     ```

   - **Relationships:**
     - Handle one-to-one, one-to-many, and many-to-many relationships
     - Consider nullable vs. non-nullable fields
     ```graphql
     type Order {
       id: ID!
       user: User!
       items: [OrderItem!]!
       total: Float!
     }
     ```

   - **Input Types:**
     - Create input types for mutations
     - Consider validation requirements
     ```graphql
     input CreateUserInput {
       name: String!
       email: String!
       password: String!
     }
     ```

   - **Interfaces and Unions:**
     - Define interfaces for shared fields
     - Use unions for polymorphic relationships
     ```graphql
     interface Node {
       id: ID!
     }

     union SearchResult = User | Order | Product
     ```

2. **Query Operations:**
   - **Base Queries:**
     - Single item retrieval
     - List retrieval with filtering
     - Search operations
     ```graphql
     type Query {
       user(id: ID!): User
       users(filter: UserFilter, limit: Int, offset: Int): [User!]!
       search(term: String!): [SearchResult!]!
     }
     ```

   - **Filtering System:**
     - Define filter input types
     - Support complex filtering operations
     ```graphql
     input UserFilter {
       name: StringFilter
       age: IntFilter
       AND: [UserFilter!]
       OR: [UserFilter!]
     }

     input StringFilter {
       eq: String
       contains: String
       startsWith: String
       in: [String!]
     }
     ```

   - **Pagination:**
     - Implement cursor-based pagination
     - Support limit/offset pagination
     ```graphql
     type UserConnection {
       edges: [UserEdge!]!
       pageInfo: PageInfo!
       totalCount: Int!
     }

     type UserEdge {
       node: User!
       cursor: String!
     }

     type PageInfo {
       hasNextPage: Boolean!
       hasPreviousPage: Boolean!
       startCursor: String
       endCursor: String
     }
     ```

3. **Mutation Operations:**
   - **Create Operations:**
     ```graphql
     type Mutation {
       createUser(input: CreateUserInput!): CreateUserPayload!
       updateUser(id: ID!, input: UpdateUserInput!): UpdateUserPayload!
       deleteUser(id: ID!): DeleteUserPayload!
     }

     type CreateUserPayload {
       user: User
       errors: [Error!]
     }
     ```

   - **Batch Operations:**
     ```graphql
     input BatchCreateUserInput {
       users: [CreateUserInput!]!
     }

     type BatchCreateUserPayload {
       users: [User!]!
       errors: [BatchError!]!
     }
     ```

   - **Error Handling:**
     ```graphql
     type Error {
       field: String
       message: String!
       code: ErrorCode!
     }

     type BatchError {
       index: Int!
       errors: [Error!]!
     }

     enum ErrorCode {
       INVALID_INPUT
       NOT_FOUND
       UNAUTHORIZED
       INTERNAL_ERROR
     }
     ```

4. **Subscription Operations:**
   ```graphql
   type Subscription {
     userUpdated(id: ID): User!
     newOrder: Order!
     notifications(userId: ID!): Notification!
   }
   ```

5. **Directives:**
   ```graphql
   directive @auth(
     requires: Role = USER
   ) on OBJECT | FIELD_DEFINITION

   directive @deprecated(
     reason: String = "No longer supported"
   ) on FIELD_DEFINITION | ENUM_VALUE

   enum Role {
     ADMIN
     USER
     GUEST
   }
   ```

**Part 2: Implementation Guidelines**

1. **Resolver Structure:**
   ```typescript
   // Example resolver structure
   const resolvers = {
     Query: {
       user: (parent, { id }, context) => {},
       users: (parent, { filter, limit, offset }, context) => {}
     },
     Mutation: {
       createUser: (parent, { input }, context) => {}
     },
     User: {
       orders: (parent, args, context) => {}
     }
   }
   ```

2. **Context and Authentication:**
   ```typescript
   interface Context {
     user: User | null;
     dataSources: DataSources;
     authenticate: () => Promise<User>;
   }
   ```

3. **Best Practices:**
    - Use DataLoader for N+1 query prevention
    - Implement proper error handling
    - Follow naming conventions
    - Add field-level documentation
    - Consider rate limiting
    - Implement proper authorization

**Additional Considerations:**

1. **Performance:**
    - Query complexity analysis
    - Field-level cost calculation
    - Caching strategies
    - Batching optimizations

2. **Security:**
    - Input validation
    - Authorization checks
    - Rate limiting
    - Query depth limiting

3. **Testing:**
    - Unit tests for resolvers
    - Integration tests for operations
    - Schema validation tests
    - Performance benchmarks

**Output Format Requirements:**

1. **Schema Organization:**
    - Separate files for different concerns
    - Clear module structure
    - Proper type imports/exports

2. **Documentation:**
    - Schema documentation
    - Operation examples
    - Use cases
    - Error scenarios

Please provide your ALPS document and I'll help you convert it to a GraphQL implementation following these guidelines.

_YOUR_ALPS_HERE_

</User></pre>

## TypeScript type definitions

<pre>
**Task:** Convert the provided ALPS (Application-Level Profile Semantics) file into TypeScript type definitions, interfaces, and related utilities.

**Part 1: Core Type Definitions**

1. **Base Types and Interfaces:**
    - **Entity Types:**
        ```typescript
        // Example of expected output:
        interface User {
          id: string;
          email: string;
          name: string;
          status: UserStatus;
          createdAt: Date;
          updatedAt: Date;
        }

        enum UserStatus {
          Active = 'ACTIVE',
          Inactive = 'INACTIVE',
          Suspended = 'SUSPENDED'
        }
        ```

    - **Nested Types:**
        ```typescript
        interface Address {
          street: string;
          city: string;
          postalCode: string;
          country: string;
        }

        interface UserWithAddress extends User {
          address?: Address;
        }
        ```

2. **Utility Types:**
    - **Partial Types:**
        ```typescript
        type UpdateUserPayload = Partial<Omit<User, 'id' | 'createdAt' | 'updatedAt'>>;
        ```
    
    - **Pick Types:**
        ```typescript
        type UserCredentials = Pick<User, 'email' | 'password'>;
        ```
    
    - **Record Types:**
        ```typescript
        type UsersByID = Record<string, User>;
        ```

3. **Generic Types:**
    - **Response Wrappers:**
        ```typescript
        interface PaginatedResponse<T> {
          items: T[];
          totalCount: number;
          pageInfo: {
            hasNextPage: boolean;
            hasPreviousPage: boolean;
            startCursor: string;
            endCursor: string;
          };
        }
        ```

    - **Error Handling:**
        ```typescript
        interface ApiError {
          code: string;
          message: string;
          field?: string;
        }

        type Result<T> = 
          | { success: true; data: T }
          | { success: false; error: ApiError };
        ```

**Part 2: API Types**

1. **Request/Response Types:**
    ```typescript
    // Request types
    interface CreateUserRequest {
      email: string;
      name: string;
      password: string;
      address?: Address;
    }

    interface UpdateUserRequest {
      userId: string;
      data: UpdateUserPayload;
    }

    // Response types
    interface CreateUserResponse {
      user: User;
      token: string;
    }

    interface UpdateUserResponse {
      user: User;
      modified: Array<keyof User>;
    }
    ```

2. **Query Parameters:**
    ```typescript
    interface UserQueryParams {
      search?: string;
      status?: UserStatus;
      sortBy?: keyof User;
      sortOrder?: 'asc' | 'desc';
      page?: number;
      pageSize?: number;
    }
    ```

3. **API Client Types:**
    ```typescript
    interface ApiClient {
      users: {
        create(data: CreateUserRequest): Promise<Result<CreateUserResponse>>;
        update(data: UpdateUserRequest): Promise<Result<UpdateUserResponse>>;
        delete(userId: string): Promise<Result<void>>;
        get(userId: string): Promise<Result<User>>;
        list(params: UserQueryParams): Promise<Result<PaginatedResponse<User>>>;
      };
    }
    ```

**Part 3: Validation Schemas**

1. **Zod Schemas:**
    ```typescript
    import { z } from 'zod';

    const UserSchema = z.object({
      id: z.string().uuid(),
      email: z.string().email(),
      name: z.string().min(2).max(100),
      status: z.enum(['ACTIVE', 'INACTIVE', 'SUSPENDED']),
      createdAt: z.date(),
      updatedAt: z.date()
    });

    type UserFromSchema = z.infer<typeof UserSchema>;
    ```

2. **Custom Validators:**
    ```typescript
    type Validator<T> = {
      validate: (value: unknown) => value is T;
      errors: () => string[];
    };
    ```

**Part 4: Helper Types**

1. **State Management:**
    ```typescript
    interface EntityState<T> {
      data: Record<string, T>;
      loading: boolean;
      error: ApiError | null;
      selectedId: string | null;
    }

    type EntityActions<T> = 
      | { type: 'SET_DATA'; payload: Record<string, T> }
      | { type: 'SET_LOADING'; payload: boolean }
      | { type: 'SET_ERROR'; payload: ApiError | null }
      | { type: 'SELECT'; payload: string | null };
    ```

2. **Event Types:**
    ```typescript
    interface EntityEvent<T> {
      type: 'created' | 'updated' | 'deleted';
      entity: T;
      timestamp: Date;
      actor: string;
    }
    ```

**Additional Considerations:**

1. **Type Guards:**
    ```typescript
    function isUser(value: unknown): value is User {
      return (
        typeof value === 'object' &&
        value !== null &&
        'id' in value &&
        'email' in value &&
        'name' in value
      );
    }
    ```

2. **Mapped Types:**
    ```typescript
    type ResourceActions<T> = {
      [K in keyof T as `update${Capitalize<string & K>}`]: 
        (value: T[K]) => Promise<void>
    };
    ```

3. **Conditional Types:**
    ```typescript
    type NonNullableFields<T> = {
      [K in keyof T]: NonNullable<T[K]>;
    };
    ```

**Output Requirements:**

1. **File Organization:**
    ```typescript
    // models/index.ts
    export * from './user';
    export * from './address';
    
    // models/user.ts
    export interface User { ... }
    export type UserCreate = ...
    export type UserUpdate = ...
    ```

2. **Documentation:**
    ```typescript
    /**
     * Represents a user in the system
     * @property {string} id - Unique identifier
     * @property {string} email - User's email address
     */
    export interface User {
      id: string;
      email: string;
      // ...
    }
    ```

3. **Type Exports:**
    ```typescript
    export type {
      User,
      UserCreate,
      UserUpdate,
      UserQueryParams,
      // ...
    };
    ```
_YOUR_ALPS_HERE_

</pre>


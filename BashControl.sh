#!/bin/bash

BASE_URL="http://127.0.0.1:8000/api"

# Function to handle task creation
create_task() {
  TITLE=$1
  DESCRIPTION=$2
  DUE_DATE=$3
  PRIORITY=$4
  ASSIGNED=$5

  curl -X POST -H "Content-Type: application/json" -d '{
    "title": "'"$TITLE"'",
    "description": "'"$DESCRIPTION"'",
    "due_date": "'"$DUE_DATE"'",
    "priority": "'"$PRIORITY"'",
    "task_owner": "'"$ASSIGNED"'"
  }' $BASE_URL/tasks
}

# Function to list all tasks
list_tasks() {
  curl -X GET $BASE_URL/allTasks
}

# Function to list tasks expiring today
list_tasks_expiring_today() {
  curl -X GET $BASE_URL/tasksfilter?expiring=today
}

# Function to list tasks by status
list_tasks_by_status() {
  STATUS=$1
  curl -X GET $BASE_URL/tasksfilter?status="$STATUS"
}

# Function to mark a task as done
mark_task_done() {
  TASK_ID=$1
  curl -X POST -H "Content-Type: application/json" -d '{"status": "completed"}' $BASE_URL/tasks/$TASK_ID
}

# Function to update a task
update_task() {
 
 TASK_ID=$1
DESCRIPTION=""
TITLE=""
PRIORITY=""
STATUS=""
DUE_DATE=""
TASK_OWNER=""

shift

# Loop through the arguments and assign values to variables
while [ $# -gt 0 ]; do
  case $1 in
    "--description")
      DESCRIPTION=$2
      shift 2
      ;;
    "--title")
      TITLE=$2
      shift 2
      ;;
    "--priority")
      PRIORITY=$2
      shift 2
      ;;
    "--status")
      STATUS=$2
      shift 2
      ;;
    "--due_date")
      DUE_DATE=$2
      shift 2
      ;;
    "--task_owner")
      TASK_OWNER=$2
      shift 2
      ;;
    *)
      echo "Invalid argument: $1"
      exit 1
      ;;
  esac
done

PAYLOAD="{}"

# Build the payload JSON object based on the provided arguments
if [ -n "$DESCRIPTION" ]; then
  PAYLOAD=$(echo $PAYLOAD | jq --arg desc "$DESCRIPTION" '. + {description: $desc}')
fi

if [ -n "$TITLE" ]; then
  PAYLOAD=$(echo $PAYLOAD | jq --arg title "$TITLE" '. + {title: $title}')
fi

if [ -n "$PRIORITY" ]; then
  PAYLOAD=$(echo $PAYLOAD | jq --arg prio "$PRIORITY" '. + {priority: $prio}')
fi

if [ -n "$STATUS" ]; then
  PAYLOAD=$(echo $PAYLOAD | jq --arg stat "$STATUS" '. + {status: $stat}')
fi

if [ -n "$DUE_DATE" ]; then
  PAYLOAD=$(echo $PAYLOAD | jq --arg date "$DUE_DATE" '. + {due_date: $date}')
fi

if [ -n "$TASK_OWNER" ]; then
  PAYLOAD=$(echo $PAYLOAD | jq --arg owner "$TASK_OWNER" '. + {task_owner: $owner}')
fi

curl -X POST -H "Content-Type: application/json" -d "$PAYLOAD" "$BASE_URL/tasks/$TASK_ID"

}

# Function to delete a task
delete_task() {
  TASK_ID=$1
  curl -X DELETE $BASE_URL/tasks/$TASK_ID
}

# Check the command and execute the appropriate function
case $1 in
  "add")
    create_task "$2" "$3" "$4" "$5" "$6"
    ;;
  "list")
    list_tasks
    ;;
  "expiring-today")
    list_tasks_expiring_today
    ;;
  "status")
    list_tasks_by_status "$2"
    ;;
  "done")
    mark_task_done "$2"
    ;;
  "update")
    shift
    update_task "$@"
    ;;
  "delete")
    delete_task "$2"
    ;;
  *)
    echo "Invalid command."
    ;;
esac

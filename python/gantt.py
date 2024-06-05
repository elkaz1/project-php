import plotly.express as px
import pandas as pd

# Create a DataFrame with your project plan
df = pd.DataFrame([
    dict(Task="Collect Data", Start='2024-05-01', Finish='2024-05-05'),
    dict(Task="Data Preprocessing", Start='2024-05-06', Finish='2024-05-10'),
    dict(Task="Model Development", Start='2024-05-11', Finish='2024-05-20'),
    dict(Task="Integration with API", Start='2024-05-21', Finish='2024-05-25'),
    dict(Task="Frontend Development", Start='2024-05-26', Finish='2024-06-01'),
    dict(Task="Testing and Debugging", Start='2024-06-02', Finish='2024-06-05'),
    dict(Task="Documentation", Start='2024-06-06', Finish='2024-06-09'),
    dict(Task="Final Review and Submission", Start='2024-06-10', Finish='2024-06-10')
])

# Create the Gantt chart
fig = px.timeline(df, x_start="Start", x_end="Finish", y="Task", title="Project Gantt Chart")
fig.update_yaxes(categoryorder="total ascending")

# Add annotations
annotations = []
for index, row in df.iterrows():
    start_date = pd.to_datetime(row['Start'])
    finish_date = pd.to_datetime(row['Finish'])
    midpoint = start_date + (finish_date - start_date) / 2
    annotations.append(dict(
        x=midpoint,
        y=index,
        text=f"Task: {row['Task']}<br>Start: {row['Start']}<br>Finish: {row['Finish']}",
        showarrow=False,
        font=dict(size=10),
        xanchor='center',
        yanchor='bottom'
    ))

fig.update_layout(annotations=annotations)

# Show the plot
fig.show()
